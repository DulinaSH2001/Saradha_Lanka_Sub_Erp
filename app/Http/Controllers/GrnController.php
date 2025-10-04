<?php

namespace App\Http\Controllers;

use App\Models\Grn;
use App\Models\GrnItem;
use App\Models\Supplier;
use App\Models\Site;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class GrnController extends Controller
{
    public function index(Request $request): View
    {
        $query = Grn::with('supplier', 'site')->orderBy('date', 'desc');

        if ($request->has('search') && $request->search) {
            $s = $request->search;
            $query->where('grn_no', 'like', '%' . $s . '%')
                ->orWhere('reference_no', 'like', '%' . $s . '%');
        }

        $grns = $query->paginate(15);

        return view('masters.grns.index', compact('grns'));
    }

    public function create(): View
    {
        $suppliers = Supplier::orderBy('name')->get();
        $sites = Site::orderBy('name')->get();
        $items = Item::orderBy('name')->get();
        $accounts = \App\Models\Account::orderBy('name')->get();

        return view('masters.grns.create', compact('suppliers', 'sites', 'items', 'accounts'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'site_id' => 'nullable|exists:sites,id',
            'grn_no' => 'required|string|unique:grns,grn_no',
            'date' => 'required|date|after_or_equal:today',
            'reference_no' => 'nullable|string',
            'grn_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'account_id' => 'nullable|exists:accounts,id',
            'memo' => 'nullable|string',
        ]);

        // Items validation (simple)
        $items = $request->input('items', []);

        $grn = Grn::create(array_merge($validated, [
            'subtotal' => 0,
            'discount_percent' => $request->input('discount_percent', 0),
            'discount_amount' => $request->input('discount_amount', 0),
            'vat_percent' => $request->input('vat_percent', 0),
            'vat_amount' => 0,
            'total' => 0,
        ]));

        $subtotal = 0;
        foreach ($items as $row) {
            if (empty($row['item_code']) && empty($row['description']))
                continue;
            $amount = ((float) ($row['qty'] ?? 0)) * ((float) ($row['rate'] ?? 0));
            $disc_amount = ($amount * ((float) ($row['disc_percent'] ?? 0))) / 100;
            $total = $amount - $disc_amount;
            $subtotal += $amount;

            $grn->items()->create([
                'item_id' => $row['item_id'] ?? null,
                'item_code' => $row['item_code'] ?? null,
                'description' => $row['description'] ?? null,
                'qty' => $row['qty'] ?? 0,
                'rate' => $row['rate'] ?? 0,
                'amount' => $amount,
                'disc_percent' => $row['disc_percent'] ?? 0,
                'disc_amount' => $disc_amount,
                'total' => $total,
            ]);
        }

        $discount_amount = $request->input('discount_amount', 0);
        if (!$discount_amount && $request->input('discount_percent', 0)) {
            $discount_amount = ($subtotal * $request->input('discount_percent', 0)) / 100;
        }

        $vat_amount = ($subtotal - $discount_amount) * ($request->input('vat_percent', 0) / 100);
        $total = $subtotal - $discount_amount + $vat_amount;

        $grn->update([
            'subtotal' => $subtotal,
            'discount_amount' => $discount_amount,
            'vat_amount' => $vat_amount,
            'total' => $total,
        ]);

        return redirect()->route('grns.index')->with('success', 'GRN created successfully.');
    }

    public function edit(Grn $grn): View
    {
        $suppliers = Supplier::orderBy('name')->get();
        $sites = Site::orderBy('name')->get();
        $items = Item::orderBy('name')->get();
        $accounts = \App\Models\Account::orderBy('name')->get();

        $grn->load('items');

        return view('masters.grns.edit', compact('grn', 'suppliers', 'sites', 'items', 'accounts'));
    }

    public function update(Request $request, Grn $grn): RedirectResponse
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'site_id' => 'nullable|exists:sites,id',
            'grn_no' => 'required|string|unique:grns,grn_no,' . $grn->id,
            'date' => 'required|date|after_or_equal:today',
            'reference_no' => 'nullable|string',
            'grn_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'account_id' => 'nullable|exists:accounts,id',
            'memo' => 'nullable|string',
        ]);

        $grn->update($validated);

        $items = $request->input('items', []);
        $grn->items()->delete();

        $subtotal = 0;
        foreach ($items as $row) {
            if (empty($row['item_code']) && empty($row['description']))
                continue;
            $amount = ((float) ($row['qty'] ?? 0)) * ((float) ($row['rate'] ?? 0));
            $disc_amount = ($amount * ((float) ($row['disc_percent'] ?? 0))) / 100;
            $total = $amount - $disc_amount;
            $subtotal += $amount;

            $grn->items()->create([
                'item_id' => $row['item_id'] ?? null,
                'item_code' => $row['item_code'] ?? null,
                'description' => $row['description'] ?? null,
                'qty' => $row['qty'] ?? 0,
                'rate' => $row['rate'] ?? 0,
                'amount' => $amount,
                'disc_percent' => $row['disc_percent'] ?? 0,
                'disc_amount' => $disc_amount,
                'total' => $total,
            ]);
        }

        $discount_amount = $request->input('discount_amount', 0);
        if (!$discount_amount && $request->input('discount_percent', 0)) {
            $discount_amount = ($subtotal * $request->input('discount_percent', 0)) / 100;
        }

        $vat_amount = ($subtotal - $discount_amount) * ($request->input('vat_percent', 0) / 100);
        $total = $subtotal - $discount_amount + $vat_amount;

        $grn->update([
            'subtotal' => $subtotal,
            'discount_amount' => $discount_amount,
            'vat_amount' => $vat_amount,
            'total' => $total,
        ]);

        return redirect()->route('grns.index')->with('success', 'GRN updated successfully.');
    }

    public function destroy(Grn $grn): RedirectResponse
    {
        $grn->delete();
        return redirect()->route('grns.index')->with('success', 'GRN deleted successfully.');
    }
}
