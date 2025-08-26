<?php

namespace App\Http\Controllers\Payment\Product;

use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use App\Models\BasicExtended;
use App\Models\BasicSetting;
use App\Models\PaymentGateway;
use App\Models\PostalCode;
use App\Models\ProductOrder;
use App\Models\ShippingCharge;
use Str;
use Session;

class PaystackController extends PaymentController
{
    public $secret_key;

    public function __construct()
    {
        $data = PaymentGateway::whereKeyword('paystack')->first();
        $paydata = $data->convertAutoData();
        $this->secret_key = $paydata['key'];
    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return
     */
    public function store(Request $request)
    {
        $be = BasicExtended::first();
        if ($be->base_currency_text != "NGN") {
            return back()->with('error', 'Currency must be NGN for Paystack');
        }

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
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
                'amount' => $order->total * 100,
                'email' => $order->billing_email,
                'callback_url' => route('product.paystack.notify', ['order_id' => $orderId])
            ]),
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer " . $this->secret_key,
                "content-type: application/json",
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return back()->with('error', 'Something went wrong!');
        }

        $result = json_decode($response);

        if ($result->status == 1) {
            return redirect($result->data->authorization_url);
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function notify(Request $request) {
        $order = ProductOrder::find($request->order_id);
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $request->trxref,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "authorization: Bearer " . $this->secret_key,
                "cache-control: no-cache"
            ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return back()->with('error', 'Something went wrong!');
        }

        $result = json_decode($response);

        if ($result->status == 1 && $result->data->status == 'success') {
            $order->payment_status = 'Completed';
            $order->order_status = 'Processing';
            $order->save();

            Session::forget('cart');
            
            return redirect()->route('product.payment.return', $order->order_number);
        } else {
            $order->payment_status = 'Failed';
            $order->order_status = 'Failed';
            $order->save();

            return redirect()->route('product.payment.cancle');
        }
    }
} 