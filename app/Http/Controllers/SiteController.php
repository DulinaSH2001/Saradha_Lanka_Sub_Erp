<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Site::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('manager_name', 'like', "%{$search}%");
            });
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
            }
        }

        $sites = $query->orderBy('name')->paginate(15);

        // Statistics for the dashboard
        $stats = [
            'total' => Site::count(),
            'warehouses' => Site::where('type', 'warehouse')->count(),
            'retail_outlets' => Site::where('type', 'retail_outlet')->count(),
            'offices' => Site::where('type', 'office')->count(),
        ];

        return view('masters.sites.index', compact('sites', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('masters.sites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sites,code',
            'type' => 'required|in:warehouse,retail_outlet,office,distribution_center',
            'description' => 'nullable|string',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'manager_name' => 'nullable|string|max:255',
            'manager_phone' => 'nullable|string|max:20',
            'manager_email' => 'nullable|email|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_active' => 'boolean',
            'storage_capacity' => 'nullable|integer|min:0',
            'operating_hours' => 'nullable|string|max:255',
        ]);

        $site = Site::create($validated);

        return redirect()->route('sites.index')
            ->with('success', 'Site created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site): View
    {
        return view('masters.sites.show', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site): View
    {
        return view('masters.sites.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sites,code,' . $site->id,
            'type' => 'required|in:warehouse,retail_outlet,office,distribution_center',
            'description' => 'nullable|string',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'manager_name' => 'nullable|string|max:255',
            'manager_phone' => 'nullable|string|max:20',
            'manager_email' => 'nullable|email|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'is_active' => 'boolean',
            'storage_capacity' => 'nullable|integer|min:0',
            'operating_hours' => 'nullable|string|max:255',
        ]);

        $site->update($validated);

        return redirect()->route('sites.index')
            ->with('success', 'Site updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site): RedirectResponse
    {
        $site->delete();

        return redirect()->route('sites.index')
            ->with('success', 'Site deleted successfully.');
    }

    /**
     * Toggle site status
     */
    public function toggleStatus(Site $site): RedirectResponse
    {
        $site->update(['is_active' => !$site->is_active]);

        $status = $site->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Site {$status} successfully.");
    }
}
