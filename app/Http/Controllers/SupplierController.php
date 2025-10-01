<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Supplier::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('contact_person', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Filter by company type
        if ($request->has('company_type') && $request->company_type && $request->company_type !== 'all') {
            $query->where('company_type', $request->company_type);
        }

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'verified') {
                $query->where('is_verified', true);
            } elseif ($request->status === 'preferred') {
                $query->where('is_preferred', true);
            }
        }

        $suppliers = $query->orderBy('name')->paginate(15);

        // Statistics for the dashboard
        $stats = [
            'total' => Supplier::count(),
            'active' => Supplier::where('is_active', true)->count(),
            'verified' => Supplier::where('is_verified', true)->count(),
            'preferred' => Supplier::where('is_preferred', true)->count(),
        ];

        return view('masters.suppliers.index', compact('suppliers', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('masters.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:suppliers,code',
            'company_name' => 'nullable|string|max:255',
            'company_type' => 'required|in:corporation,partnership,sole_proprietorship,llc,other',
            'category' => 'required|in:material,service,both',
            'contact_person' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'tax_number' => 'nullable|string|max:50',
            'registration_number' => 'nullable|string|max:50',
            'payment_terms' => 'nullable|string|max:255',
            'credit_limit' => 'nullable|numeric|min:0',
            'credit_period' => 'nullable|integer|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_routing_number' => 'nullable|string|max:50',
            'rating' => 'nullable|integer|min:1|max:5',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
            'is_preferred' => 'boolean',
        ]);

        $supplier = Supplier::create($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier): View
    {
        return view('masters.suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier): View
    {
        return view('masters.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:suppliers,code,' . $supplier->id,
            'company_name' => 'nullable|string|max:255',
            'company_type' => 'required|in:corporation,partnership,sole_proprietorship,llc,other',
            'category' => 'required|in:material,service,both',
            'contact_person' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'address_line_1' => 'nullable|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'tax_number' => 'nullable|string|max:50',
            'registration_number' => 'nullable|string|max:50',
            'payment_terms' => 'nullable|string|max:255',
            'credit_limit' => 'nullable|numeric|min:0',
            'credit_period' => 'nullable|integer|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:50',
            'bank_routing_number' => 'nullable|string|max:50',
            'rating' => 'nullable|integer|min:1|max:5',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
            'is_verified' => 'boolean',
            'is_preferred' => 'boolean',
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier): RedirectResponse
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier deleted successfully.');
    }

    /**
     * Toggle supplier status
     */
    public function toggleStatus(Supplier $supplier): RedirectResponse
    {
        $supplier->update(['is_active' => !$supplier->is_active]);

        $status = $supplier->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Supplier {$status} successfully.");
    }
}
