<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Item::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('barcode', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter by type
        if ($request->has('type') && $request->type && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'low_stock') {
                $query->whereColumn('current_stock', '<=', 'minimum_stock_level');
            }
        }

        $items = $query->orderBy('name')->paginate(15);

        // Statistics for the dashboard
        $stats = [
            'total' => Item::count(),
            'active' => Item::where('is_active', true)->count(),
            'low_stock' => Item::whereColumn('current_stock', '<=', 'minimum_stock_level')->count(),
            'out_of_stock' => Item::where('current_stock', 0)->count(),
        ];

        return view('masters.items.index', compact('items', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('masters.items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:items,code',
            'category' => 'required|in:raw_material,finished_goods,semi_finished,consumables,spare_parts,tools',
            'type' => 'required|in:product,service,asset,consumable',
            'description' => 'nullable|string',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'specifications' => 'nullable|string',
            'unit_of_measure' => 'required|string|max:50',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'minimum_stock_level' => 'required|integer|min:0',
            'maximum_stock_level' => 'required|integer|min:0',
            'reorder_point' => 'required|integer|min:0',
            'current_stock' => 'required|integer|min:0',
            'supplier_name' => 'nullable|string|max:255',
            'supplier_contact' => 'nullable|string|max:20',
            'supplier_email' => 'nullable|email|max:255',
            'barcode' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'is_serialized' => 'boolean',
            'warranty_period' => 'nullable|integer|min:0',
            'expiry_tracking' => 'boolean',
        ]);

        $item = Item::create($validated);

        return redirect()->route('items.index')
            ->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): View
    {
        return view('masters.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item): View
    {
        return view('masters.items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:items,code,' . $item->id,
            'category' => 'required|in:raw_material,finished_goods,semi_finished,consumables,spare_parts,tools',
            'type' => 'required|in:product,service,asset,consumable',
            'description' => 'nullable|string',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'specifications' => 'nullable|string',
            'unit_of_measure' => 'required|string|max:50',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'minimum_stock_level' => 'required|integer|min:0',
            'maximum_stock_level' => 'required|integer|min:0',
            'reorder_point' => 'required|integer|min:0',
            'current_stock' => 'required|integer|min:0',
            'supplier_name' => 'nullable|string|max:255',
            'supplier_contact' => 'nullable|string|max:20',
            'supplier_email' => 'nullable|email|max:255',
            'barcode' => 'nullable|string|max:255',
            'sku' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'dimensions' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'is_serialized' => 'boolean',
            'warranty_period' => 'nullable|integer|min:0',
            'expiry_tracking' => 'boolean',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('items.index')
            ->with('success', 'Item deleted successfully.');
    }

    /**
     * Toggle item status
     */
    public function toggleStatus(Item $item): RedirectResponse
    {
        $item->update(['is_active' => !$item->is_active]);

        $status = $item->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Item {$status} successfully.");
    }
}
