<?php

namespace App\Http\Controllers\Payment\product;

use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use App\Http\Controllers\Payment\product\PaymentController;
use App\Models\BasicSetting;
use Config;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\Exception;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Models\PaymentGateway;
use App\Models\Language;
use App\Models\PostalCode;
use App\Models\ProductOrder;
use App\Models\ShippingCharge;
use Auth;
use Session;

class StripeController extends PaymentController
{
    public function __construct()
    {
        //Set Spripe Keys
        $stripe = PaymentGateway::findOrFail(14);
        $stripeConf = json_decode($stripe->information, true);
        Config::set('services.stripe.key', $stripeConf["key"]);
        Config::set('services.stripe.secret', $stripeConf["secret"]);
    }


    public function store(Request $request)
    {
        // Check if session is valid
        if (!$request->session()->has('cart')) {
            return back()->with('error', 'Your session has expired. Please refresh the page and try again.');
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

        // save order
        $txnId = 'txn_' . Str::random(8) . time();
        $chargeId = 'ch_' . Str::random(9) . time();
        $order = $this->saveOrder($request, $shipping, $total, $txnId, $chargeId);
        $order_id = $order->id;

        // save ordered items
        $this->saveOrderItem($order_id);

        // Check if this token has already been used
        if (Session::has('token_used_' . $request->stripeToken)) {
            return back()->with('error', 'This payment token has already been used. Please try again with a new payment method.');
        }

        // Store the Stripe token instead of raw card data
        session()->put('stripe_token', $request->stripeToken);

        return $this->apiRequest($order_id);

    }


    // send API request & redirect
    public function apiRequest($orderId) {
        $order = ProductOrder::find($orderId);
        $stripeToken = session()->get('stripe_token');

        if (!$order) {
            return back()->with('error', 'Order not found. Please try again.');
        }

        if (!$stripeToken) {
            return back()->with('error', 'Payment token not found. Please try again.');
        }

        // Check if this order has already been processed
        if ($order->payment_status === 'Completed') {
            Session::forget('coupon');
            Session::forget('cart');
            Session::forget('stripe_token');
            
            if ($order->type == 'website') {
                $success_url = route('product.payment.return', $order->order_number);
            } elseif ($order->type == 'qr') {
                $success_url = route('qr.payment.return', $order->order_number);
            }
            
            return redirect($success_url)->with('info', 'Order has already been processed successfully.');
        }

        // Check if this token has already been used
        if (Session::has('token_used_' . $stripeToken)) {
            return back()->with('error', 'This payment token has already been used. Please try again with a new payment method.');
        }

        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $be = $currentLang->basic_extended;
        $usdTotal = round(($order->total / $be->base_currency_rate), 2);
        $title = 'Product Checkout';
        if ($order->type == 'website') {
            $success_url = route('product.payment.return', $order->order_number);
        } elseif ($order->type == 'qr') {
            $success_url = route('qr.payment.return', $order->order_number);
        }

        $stripe = Stripe::make(Config::get('services.stripe.secret'));
        try {
            // Mark token as used immediately to prevent duplicate usage
            Session::put('token_used_' . $stripeToken, true);
            
            // Use the token directly instead of creating one from raw card data
            $charge = $stripe->charges()->create([
                'card' => $stripeToken,
                'currency' =>  'USD',
                'amount' => $usdTotal * 100, // Stripe expects amount in cents
                'description' => $title,
                'metadata' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                ],
            ]);

            if ($charge['status'] == 'succeeded') {
                $order->payment_status = 'Completed';
                $order->save();

                // Send notifications asynchronously to avoid timeout
                try {
                    $this->sendNotifications($order);
                } catch (\Exception $e) {
                    // Log the error but don't fail the payment
                    \Log::warning('Notification failed for order ' . $order->id . ': ' . $e->getMessage());
                }

                // Clear all session data
                Session::forget('coupon');
                Session::forget('cart');
                Session::forget('stripe_token');
                
                // Add success message to session
                Session::flash('success', 'Payment completed successfully! Order #' . $order->order_number . ' has been confirmed.');
                
                // Add a unique identifier to prevent reload issues
                Session::put('payment_completed_' . $order->id, true);

                return redirect($success_url)->with('payment_id', $charge['id']);
            } else {
                // Remove the token used flag if payment failed
                Session::forget('token_used_' . $stripeToken);
                return back()->with('error', 'Payment processing failed. Please try again.');
            }
        } catch (Exception $e) {
            // Remove the token used flag if there was an error
            Session::forget('token_used_' . $stripeToken);
            return back()->with('error', 'Payment processing failed: ' . $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
            // Remove the token used flag if there was a card error
            Session::forget('token_used_' . $stripeToken);
            return back()->with('error', 'Card error: ' . $e->getMessage());
        } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
            // Remove the token used flag if there was a missing parameter error
            Session::forget('token_used_' . $stripeToken);
            return back()->with('error', 'Payment configuration error: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Remove the token used flag if there was an unexpected error
            Session::forget('token_used_' . $stripeToken);
            return back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }
}
