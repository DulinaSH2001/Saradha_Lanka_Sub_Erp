<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(Request $request): View
    {
        $query = Account::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->has('type') && $request->type && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('is_active', $request->status === 'active');
        }

        // Get stats
        $stats = [
            'total' => Account::count(),
            'active' => Account::where('is_active', true)->count(),
            'inactive' => Account::where('is_active', false)->count(),
            'total_balance' => Account::where('is_active', true)->sum('balance') ?? 0,
        ];

        // Get distinct types for filter dropdown
        $types = Account::whereNotNull('type')->distinct()->pluck('type');

        $accounts = $query->orderBy('name')->paginate(15);

        return view('masters.accounts.index', compact('accounts', 'stats', 'types'));
    }

    public function create(): View
    {
        return view('masters.accounts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:accounts,code',
            'type' => 'nullable|string|in:asset,liability,equity,revenue,expense,other',
            'description' => 'nullable|string|max:1000',
            'balance' => 'nullable|numeric',
            'is_active' => 'boolean',
        ]);

        // Set default values
        $validated['balance'] = $validated['balance'] ?? 0;
        $validated['is_active'] = $validated['is_active'] ?? false;

        Account::create($validated);

        return redirect()->route('accounts.index')->with('success', 'Account created successfully.');
    }

    public function edit(Account $account): View
    {
        return view('masters.accounts.edit', compact('account'));
    }

    public function show(Account $account): View
    {
        return view('masters.accounts.show', compact('account'));
    }

    public function update(Request $request, Account $account): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:accounts,code,' . $account->id,
            'type' => 'nullable|string|in:asset,liability,equity,revenue,expense,other',
            'description' => 'nullable|string|max:1000',
            'balance' => 'nullable|numeric',
            'is_active' => 'boolean',
        ]);

        // Set default values
        $validated['balance'] = $validated['balance'] ?? 0;
        $validated['is_active'] = $validated['is_active'] ?? false;

        $account->update($validated);

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    }

    public function destroy(Account $account): RedirectResponse
    {
        $account->delete();
        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully.');
    }

    /**
     * Toggle account status
     */
    public function toggleStatus(Account $account): RedirectResponse
    {
        $account->update(['is_active' => !$account->is_active]);

        $status = $account->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Account {$status} successfully.");
    }
}
