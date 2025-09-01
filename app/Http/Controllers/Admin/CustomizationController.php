<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customization;
use App\Models\OrderItem;

class CustomizationController extends Controller
{
    public function index()
    {
        $customizations = Customization::with(['orderItem'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.customizations.index', compact('customizations'));
    }

    public function show($id)
    {
        $customization = Customization::findOrFail($id);
        return view('admin.customizations.show', compact('customization'));
    }

    public function orderCustomizations($orderId)
    {
        $orderItems = OrderItem::where('order_id', $orderId)
            ->whereHas('customization')
            ->with('customization')
            ->get();

        return view('admin.customizations.order', compact('orderItems', 'orderId'));
    }

    public function destroy($id)
    {
        $customization = Customization::findOrFail($id);
        $customization->delete();

        return redirect()->back()->with('success', 'Customization deleted successfully');
    }
}
