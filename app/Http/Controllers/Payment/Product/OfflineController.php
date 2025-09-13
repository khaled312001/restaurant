<?php

namespace App\Http\Controllers\Payment\Product;

use Illuminate\Http\Request;
use App\Models\BasicSetting;
use App\Models\PostalCode;
use App\Models\ShippingCharge;
use App\Models\OfflineGateway;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class OfflineController extends PaymentController
{
    public function store(Request $request, $gatewayid)
    {
        if($this->orderValidation($request)) {
            return $this->orderValidation($request);
        }

        // Récupérer la passerelle hors ligne sélectionnée
        $ogateway = OfflineGateway::findOrFail($gatewayid);

        // Valider et préparer le reçu si requis par la passerelle
        if ($ogateway->is_receipt == 1) {
            $request->validate([
                'receipt' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            ]);
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

        // Définir la méthode sur le nom de la passerelle hors ligne
        $order->method = $ogateway->name ?? 'offline';

        // Enregistrer le reçu si fourni
        if ($request->hasFile('receipt')) {
            $file = $request->file('receipt');
            $ext = $file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $destination = public_path('assets/front/receipt');
            if (!is_dir($destination)) {
                @mkdir($destination, 0775, true);
            }
            $file->move($destination, $filename);
            $order->receipt = $filename;
        }

        $order->payment_status = 'Pending';
        $order->order_status = 'Pending';
        $order->save();

        // Debug logging
        \Log::info('Order created with ID: ' . $order->id);
        \Log::info('Order number: ' . $order->order_number);

        Session::put('last_order_id', $order->id);
        Session::put('guest_email', $order->billing_email);
        Session::forget('cart');
        
        \Log::info('Redirecting to checkout confirm with order ID: ' . $order->id);
        return redirect()->route('checkout.confirm');
    }
} 