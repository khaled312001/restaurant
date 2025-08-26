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
        $order->user_id = auth()->id();
        $order->billing_fname = $request->billing_fname;
        $order->billing_lname = $request->billing_lname;
        $order->billing_email = $request->billing_email;
        $order->billing_number = $request->billing_number;
        $order->billing_address = $request->billing_address;
        $order->billing_city = $request->billing_city;
        $order->billing_country = $request->billing_country;
        $order->billing_zip = $request->billing_zip;
        $order->serving_method = $request->serving_method;
        $order->shipping_charge = $shipping ? $shipping->charge : 0;
        $order->total = $total;
        $order->txnid = $txnId;
        $order->charge_id = $chargeId;
        $order->payment_status = 'Pending';
        $order->order_status = 'Pending';
        $order->save();

        return $order;
    }

    protected function saveOrderItem($order_id)
    {
        $cart = Session::get('cart');
        foreach ($cart as $id => $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order_id;
            $orderItem->product_id = $id;
            $orderItem->qty = $item['qty'];
            $orderItem->price = $item['price'];
            $orderItem->save();
        }
    }
} 