<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addon;
use Illuminate\Support\Facades\Validator;

class CustomizationController extends Controller
{
    public function index()
    {
        $addons = Addon::orderBy('category')->orderBy('sort_order')->get();
        $groupedAddons = [];
        
        foreach (Addon::CATEGORIES as $category => $label) {
            $groupedAddons[$category] = [
                'label' => $label,
                'items' => $addons->where('category', $category)
            ];
        }
        
        return view('admin.customizations.index', compact('groupedAddons', 'addons'));
    }

    public function create()
    {
        $categories = Addon::CATEGORIES;
        $productTypes = Addon::PRODUCT_TYPES;
        return view('admin.customizations.create', compact('categories', 'productTypes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:' . implode(',', array_keys(Addon::CATEGORIES)),
            'price' => 'required|numeric|min:0',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'product_types' => 'nullable|array',
            'product_types.*' => 'string|in:' . implode(',', array_keys(Addon::PRODUCT_TYPES))
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Addon::create($request->all());

        return redirect()->route('admin.customizations.index')
            ->with('success', 'Addon created successfully!');
    }

    public function show($id)
    {
        $addon = Addon::findOrFail($id);
        return view('admin.customizations.show', compact('addon'));
    }

    public function edit($id)
    {
        $addon = Addon::findOrFail($id);
        $categories = Addon::CATEGORIES;
        $productTypes = Addon::PRODUCT_TYPES;
        return view('admin.customizations.edit', compact('addon', 'categories', 'productTypes'));
    }

    public function update(Request $request, $id)
    {
        $addon = Addon::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:' . implode(',', array_keys(Addon::CATEGORIES)),
            'price' => 'required|numeric|min:0',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'product_types' => 'nullable|array',
            'product_types.*' => 'string|in:' . implode(',', array_keys(Addon::PRODUCT_TYPES))
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $addon->update($request->all());

        return redirect()->route('admin.customizations.index')
            ->with('success', 'Addon updated successfully!');
    }

    public function destroy($id)
    {
        $addon = Addon::findOrFail($id);
        $addon->delete();

        return redirect()->route('admin.customizations.index')
            ->with('success', 'Addon deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $addon = Addon::findOrFail($id);
        $addon->is_active = !$addon->is_active;
        $addon->save();

        return response()->json([
            'success' => true,
            'is_active' => $addon->is_active,
            'message' => 'Addon status updated successfully!'
        ]);
    }

    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'addons' => 'required|array',
            'addons.*.id' => 'required|exists:addons,id',
            'addons.*.sort_order' => 'required|integer|min:0'
        ]);

        foreach ($request->addons as $addonData) {
            Addon::where('id', $addonData['id'])
                ->update(['sort_order' => $addonData['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sort order updated successfully!'
        ]);
    }
}
