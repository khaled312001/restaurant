<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addon;
use Illuminate\Support\Facades\Validator;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        
        return view('admin.addons.index', compact('groupedAddons', 'addons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Addon::CATEGORIES;
        return view('admin.addons.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'name_fr' => 'nullable|string|max:255',
            'category' => 'required|string|in:' . implode(',', array_keys(Addon::CATEGORIES)),
            'price' => 'required|numeric|min:0',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Addon::create($request->all());

        return redirect()->route('admin.addons.index')
            ->with('success', 'Addon created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $addon = Addon::findOrFail($id);
        return view('admin.addons.show', compact('addon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $addon = Addon::findOrFail($id);
        $categories = Addon::CATEGORIES;
        return view('admin.addons.edit', compact('addon', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $addon = Addon::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'name_fr' => 'nullable|string|max:255',
            'category' => 'required|string|in:' . implode(',', array_keys(Addon::CATEGORIES)),
            'price' => 'required|numeric|min:0',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $addon->update($request->all());

        return redirect()->route('admin.addons.index')
            ->with('success', 'Addon updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $addon = Addon::findOrFail($id);
        $addon->delete();

        return redirect()->route('admin.addons.index')
            ->with('success', 'Addon deleted successfully!');
    }

    /**
     * Toggle addon status
     */
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

    /**
     * Update sort order
     */
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
