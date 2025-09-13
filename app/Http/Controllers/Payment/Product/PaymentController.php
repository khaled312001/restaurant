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
        
        // Debug logging
        \Log::info('Checkout confirm - Order ID from session: ' . $orderId);
        
        if (!$orderId) {
            \Log::warning('No order ID found in session, trying to get latest order');
            
            // Fallback: Get the latest order for the current session
            $order = ProductOrder::where('user_id', auth()->id())
                ->orWhere('billing_email', session('guest_email'))
                ->orderBy('created_at', 'desc')
                ->first();
                
            if (!$order) {
                \Log::warning('No order found, redirecting to home');
                return redirect()->route('front.index')->with('error', 'No order found. Please try again.');
            }
            
            \Log::info('Using fallback order: ' . $order->order_number);
            return view('front.multipurpose.product.success', ['order' => $order, 'orderNum' => $order->order_number]);
        }
        
        $order = ProductOrder::find($orderId);
        if (!$order) {
            \Log::warning('Order not found with ID: ' . $orderId);
            return redirect()->route('front.index')->with('error', 'Order not found. Please try again.');
        }
        
        \Log::info('Order found: ' . $order->order_number);
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
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            \Log::warning('Empty cart when trying to save order items');
            return;
        }
        
        foreach ($cart as $key => $item) {
            // Skip if item is not an array or is empty
            if (!is_array($item) || empty($item)) {
                \Log::warning('Invalid cart item: ' . json_encode($item));
                continue;
            }
            $orderItem = new OrderItem();
            $orderItem->product_order_id = $order_id;
            $orderItem->product_id = $item['id'] ?? 0;
            $orderItem->title = $item['name'] ?? 'Unknown Product';
            $orderItem->qty = $item['qty'] ?? 1;
            $orderItem->product_price = $item['product_price'] ?? 0;
            $orderItem->total = $item['total'] ?? 0;
            $orderItem->image = $item['photo'] ?? '';
            
            // Handle variations
            if (!empty($item['variations']) && is_array($item['variations'])) {
                $orderItem->variations = json_encode($item['variations']);
                $varTotal = 0.00;
                foreach ($item['variations'] as $variation) {
                    if (is_array($variation) && array_key_exists('price', $variation)) {
                        $varTotal += (float)$variation["price"];
                    }
                }
                $orderItem->variations_price = $varTotal * ($item['qty'] ?? 1);
            }
            
            // Handle addons
            if (!empty($item['addons']) && is_array($item['addons'])) {
                $orderItem->addons = json_encode($item['addons']);
                $addonTotal = 0.00;
                foreach ($item['addons'] as $addon) {
                    if (is_array($addon) && array_key_exists('price', $addon)) {
                        $addonTotal += (float)$addon["price"];
                    }
                }
                $orderItem->addons_price = $addonTotal * ($item['qty'] ?? 1);
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
                    
                    if (is_array($customizationData)) {
                        $customization = new \App\Models\Customization();
                        $customization->order_item_id = $orderItem->id;
                        $customization->product_name = $customizationData['productName'] ?? ($item['name'] ?? 'Unknown Product');
                        $customization->product_type = $customizationData['type'] ?? 'Product';
                        $customization->price = (float)str_replace(',', '.', $customizationData['price'] ?? ($item['product_price'] ?? 0));
                        $customization->quantity = $customizationData['quantity'] ?? ($item['qty'] ?? 1);
                        $customization->meat_choice = $customizationData['meatChoice'] ?? null;
                        $customization->vegetables = $customizationData['vegetables'] ?? [];
                        $customization->drink_choice = $customizationData['drinkChoice'] ?? null;
                        $customization->sauces = $customizationData['sauces'] ?? [];
                        $customization->save();
                    }
                } catch (\Exception $e) {
                    \Log::error('Failed to save customization for order item: ' . $e->getMessage());
                }
            }
        }
    }
} 