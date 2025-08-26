<?php

namespace App\Http\Controllers\Payment\Product;

use Illuminate\Http\Request;
use App\Models\BasicExtended;
use App\Models\BasicSetting;
use App\Models\PaymentGateway;
use App\Models\PostalCode;
use App\Models\ProductOrder;
use App\Models\ShippingCharge;
use Str;
use Session;

class FlutterWaveController extends PaymentController
{
    public function store(Request $request)
    {
        if($this->orderValidation($request)) {
            return $this->orderValidation($request);
        }

        $bs = BasicSetting::select('postal_code')->firstOrFail();

        if ($request->serving_method == 'home_delivery') {
            if ($bs->postal_code == 0) {
                if ($request->has('shipping_charge')) {
                    $shipping = ShippingCharge::findOrFail($request->shipping_charge);
                    $shippig_charge = $shipping->charge;
                } else {
                    $shipping = NULL;
                    $shippig_charge = 0;
                }
            } else {
                $shipping = PostalCode::findOrFail($request->postal_code);
                $shippig_charge = $shipping->charge;
            }
            if (!empty($shipping) && !empty($shipping->free_delivery_amount) && cartTotal() >= $shipping->free_delivery_amount) {
                $shippig_charge = 0;
            } else {
                $shippig_charge = $shippig_charge;
            }
        } else {
            $shipping = NULL;
            $shippig_charge = 0;
        }
        $total = $this->orderTotal($shippig_charge);

        // saving datas in database
        $txnId = 'txn_' . Str::random(8) . time();
        $chargeId = 'ch_' . Str::random(9) . time();
        $order = $this->saveOrder($request, $shipping, $total, $txnId, $chargeId);
        $order_id = $order->id;

        // save ordered items
        $this->saveOrderItem($order_id);

        return $this->apiRequest($order_id);
    }

    public function apiRequest($orderId) {
        $order = ProductOrder::find($orderId);
        
        // FlutterWave integration would go here
        // For now, just redirect to success
        $order->payment_status = 'Completed';
        $order->order_status = 'Processing';
        $order->save();

        Session::forget('cart');
        
        return redirect()->route('product.payment.return', $order->order_number);
    }

    public function notify(Request $request) {
        // FlutterWave webhook handling would go here
        return response()->json(['status' => 'success']);
    }

    public function success(Request $request) {
        return redirect()->route('product.payment.return', $request->order_id);
    }
} 