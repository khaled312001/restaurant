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
        // Get customizations from the customizations table
        $customizations = Customization::with(['orderItem'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get customizations from order_items table (JSON format)
        $orderItemsWithCustomizations = \App\Models\OrderItem::whereNotNull('customizations')
            ->where('customizations', '!=', '')
            ->with('order')
            ->get();

        // Transform order items with JSON customizations to match the view structure
        $jsonCustomizations = collect();
        foreach ($orderItemsWithCustomizations as $orderItem) {
            $customizationData = json_decode($orderItem->customizations, true);
            if ($customizationData) {
                $jsonCustomizations->push((object) [
                    'id' => 'json_' . $orderItem->id,
                    'product_name' => $orderItem->product->name ?? 'Unknown Product',
                    'product_type' => 'Order Item',
                    'price' => $orderItem->price ?? 0,
                    'quantity' => $orderItem->quantity ?? 1,
                    'meat_choice' => $customizationData['meatChoice'] ?? null,
                    'vegetables' => $customizationData['vegetables'] ?? [],
                    'drink_choice' => $customizationData['drinkChoice'] ?? null,
                    'sauces' => $customizationData['sauces'] ?? [],
                    'addons' => $customizationData['addons'] ?? [],
                    'created_at' => $orderItem->created_at,
                    'orderItem' => $orderItem,
                    'is_json' => true
                ]);
            }
        }

        // Combine both sources and sort by creation date
        $allCustomizations = $customizations->concat($jsonCustomizations)
            ->sortByDesc('created_at');

        // Paginate manually since we have a collection
        $perPage = 20;
        $currentPage = request()->get('page', 1);
        $pagedData = $allCustomizations->forPage($currentPage, $perPage);
        
        $customizations = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $allCustomizations->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

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
