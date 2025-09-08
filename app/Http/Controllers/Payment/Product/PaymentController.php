<?php

namespace App\Http\Controllers\Payment\Product;

use App\Events\OrderPlaced;
use App\Http\Controllers\Controller;
use App\Http\Helpers\MegaMailer;
use App\Models\BasicExtended;
use App\Models\BasicExtra;
use App\Models\BasicSetting;
use App\Models\Language;
use App\Models\OrderItem;
use App\Models\PostalCode;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ServingMethod;
use App\Models\ShippingCharge;
use App\Models\TimeFrame;
use App\Notifications\WhatsappNotification;
use App\PosPaymentMethod;
use App\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    public function payreturn(Request $request, $orderNum)
    {
        $order = ProductOrder::where('order_number', $orderNum)->first();
        if (!$order) {
            return redirect()->route('front.index')->with('error', 'Order not found');
        }

        return view('front.success', compact('order'));
    }

    public function simpleCheckoutConfirm(Request $request)
    {
        $orderId = session('last_order_id');
        if (!$orderId) {
            return redirect()->route('front.index');
        }
        $order = ProductOrder::find($orderId);
        if (!$order) {
            return redirect()->route('front.index');
        }
        return view('front.multipurpose.product.success', ['order' => $order, 'orderNum' => $order->order_number]);
    }

    public function paycancle()
    {
        return redirect()->route('front.index')->with('error', 'Payment cancelled');
    }

    public function qrPayReturn(Request $request, $orderNum)
    {
        $order = ProductOrder::where('order_number', $orderNum)->first();
        if (!$order) {
            return redirect()->route('front.index')->with('error', 'Order not found');
        }

        return view('front.success', compact('order'));
    }

    public function qrPayCancle()
    {
        return redirect()->route('front.index')->with('error', 'Payment cancelled');
    }

    protected function orderValidation($request)
    {
        $rules = [
            'billing_fname' => 'required',
            'billing_lname' => 'required',
            'billing_email' => 'required|email',
            'billing_number' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_country' => 'required',
            'billing_zip' => 'required',
        ];

        if ($request->serving_method == 'home_delivery') {
            $rules['shipping_charge'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        return null;
    }

    protected function orderTotal($shipping_charge)
    {
        $total = cartTotal();
        $total += $shipping_charge;
        return $total;
    }

    protected function saveOrder($request, $shipping, $total, $txnId, $chargeId)
    {
        $order = new ProductOrder();
        $order->order_number = 'ORD-' . Str::random(8) . time();
        $order->user_id = auth()->check() ? auth()->id() : null;
        // Source de la commande (ex: website)
        if (isset($request->ordered_from) && !empty($request->ordered_from)) {
            $order->type = $request->ordered_from;
        }
        $order->billing_fname = $request->billing_fname;
        $order->billing_lname = $request->billing_lname;
        $order->billing_email = $request->billing_email;
        $order->billing_country_code = $request->billing_country_code;
        $order->billing_number = $request->billing_number;
        $order->billing_address = $request->billing_address;
        $order->billing_city = $request->billing_city;
        $order->billing_country = $request->billing_country;
        $order->billing_zip = $request->billing_zip;
        $order->serving_method = $request->serving_method;
        // Champs de retrait si fournis
        if ($request->serving_method === 'pick_up') {
            if (isset($request->pick_up_date)) {
                $order->pick_up_date = $request->pick_up_date;
            }
            if (isset($request->pick_up_time)) {
                $order->pick_up_time = $request->pick_up_time;
            }
        }
        $order->shipping_charge = $shipping ? $shipping->charge : 0;
        $order->total = $total;
        $order->txnid = $txnId;
        $order->charge_id = $chargeId;
        // Notes de commande
        if (isset($request->order_notes)) {
            $order->order_notes = $request->order_notes;
        }
        // Déduire la méthode si connue (sera éventuellement surchargée par les contrôleurs spécifiques)
        if (isset($request->method) && !empty($request->method)) {
            $order->method = $request->method;
        } elseif (isset($request->gateway) && !empty($request->gateway)) {
            $order->method = 'offline';
        }
        $order->payment_status = 'Pending';
        $order->order_status = 'Pending';
        $order->save();

        return $order;
    }

    protected function saveOrderItem($order_id)
    {
        $cart = Session::get('cart');
        foreach ($cart as $key => $item) {
            $orderItem = new OrderItem();
            $orderItem->product_order_id = $order_id;
            $orderItem->product_id = $item['id'];
            $orderItem->title = $item['name'];
            $orderItem->qty = $item['qty'];
            $orderItem->product_price = $item['product_price'];
            $orderItem->total = $item['total'];
            $orderItem->image = $item['photo'];
            
            // Handle variations
            if (!empty($item['variations'])) {
                $orderItem->variations = json_encode($item['variations']);
                $varTotal = 0.00;
                foreach ($item['variations'] as $variation) {
                    if (is_array($variation) && array_key_exists('price', $variation)) {
                        $varTotal += (float)$variation["price"];
                    }
                }
                $orderItem->variations_price = $varTotal * $item['qty'];
            }
            
            // Handle addons
            if (!empty($item['addons'])) {
                $orderItem->addons = json_encode($item['addons']);
                $addonTotal = 0.00;
                foreach ($item['addons'] as $addon) {
                    if (is_array($addon) && array_key_exists('price', $addon)) {
                        $addonTotal += (float)$addon["price"];
                    }
                }
                $orderItem->addons_price = $addonTotal * $item['qty'];
            }
            
            // Handle customizations
            if (!empty($item['customizations'])) {
                $orderItem->customizations = json_encode($item['customizations']);
            }
            
            $orderItem->save();

            // Save customization if exists
            if (!empty($item['customizations'])) {
                try {
                    $customizationData = is_string($item['customizations']) ? 
                        json_decode($item['customizations'], true) : $item['customizations'];
                    
                    $customization = new \App\Models\Customization();
                    $customization->order_item_id = $orderItem->id;
                    $customization->product_name = $customizationData['productName'] ?? $item['name'];
                    $customization->product_type = $customizationData['type'] ?? 'Product';
                    $customization->price = (float)str_replace(',', '.', $customizationData['price'] ?? $item['product_price']);
                    $customization->quantity = $customizationData['quantity'] ?? $item['qty'];
                    $customization->meat_choice = $customizationData['meatChoice'] ?? null;
                    $customization->vegetables = $customizationData['vegetables'] ?? [];
                    $customization->drink_choice = $customizationData['drinkChoice'] ?? null;
                    $customization->sauces = $customizationData['sauces'] ?? [];
                    $customization->save();
                } catch (\Exception $e) {
                    \Log::error('Failed to save customization for order item: ' . $e->getMessage());
                }
            }
        }
    }
} 