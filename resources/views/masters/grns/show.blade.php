@extends('layouts.app')

@section('title', 'View GRN - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-eye mr-2 text-blue-600"></i>
                    View Goods Received Note
                </h1>
                <p class="text-gray-600 mt-1">GRN #{{ $grn->grn_no }} - Created on {{ $grn->created_at->format('M d, Y') }}
                </p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('grns.edit', $grn) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-edit mr-2"></i>
                    Edit GRN
                </a>
                <a href="{{ route('grns.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to GRNs
                </a>
            </div>
        </div>

        <!-- Status Badge -->
        <div class="mb-6">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    {{ $grn->status === 'completed' ? 'bg-green-100 text-green-800' :
        ($grn->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                <i class="fas fa-circle mr-2 text-xs"></i>
                {{ ucfirst($grn->status ?? 'draft') }}
            </span>
        </div>

        <!-- Vendor & Order Details Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-truck mr-2 text-blue-500"></i>
                    Vendor & Order Details
                </h3>
            </div>
            <div class="p-6">
                <!-- Row 1: Supplier, Site, GRN No -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Supplier -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Supplier Name
                        </label>
                        <div class="p-3 bg-gray-50 rounded-md border">
                            {{ $grn->supplier?->name ?? 'N/A' }}
                        </div>
                    </div>

                    <!-- Site -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Site
                        </label>
                        <div class="p-3 bg-gray-50 rounded-md border">
                            {{ $grn->site?->name ?? 'N/A' }}
                            @if($grn->site)
                                ({{ $grn->site->code }})
                            @endif
                        </div>
                    </div>

                    <!-- GRN No -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            GRN No
                        </label>
                        <div class="p-3 bg-blue-50 rounded-md border border-blue-200 font-semibold text-blue-800">
                            {{ $grn->grn_no }}
                        </div>
                    </div>
                </div>

                <!-- Row 2: Date, Reference No, Invoice Date -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Date
                        </label>
                        <div class="p-3 bg-gray-50 rounded-md border">
                            {{ $grn->date?->format('M d, Y') ?? 'N/A' }}
                        </div>
                    </div>

                    <!-- Reference No -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Reference No
                        </label>
                        <div class="p-3 bg-gray-50 rounded-md border">
                            {{ $grn->reference_no ?? 'N/A' }}
                        </div>
                    </div>

                    <!-- Invoice Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Invoice Date
                        </label>
                        <div class="p-3 bg-gray-50 rounded-md border">
                            {{ $grn->invoice_date?->format('M d, Y') ?? 'N/A' }}
                        </div>
                    </div>
                </div>

                <!-- Row 3: Due Date, Supplier Address -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Due Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Due Date
                        </label>
                        <div class="p-3 bg-gray-50 rounded-md border">
                            {{ $grn->due_date?->format('M d, Y') ?? 'N/A' }}
                        </div>
                    </div>

                    <!-- Supplier Address (spans 2 columns) -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Supplier Address
                        </label>
                        <div class="p-3 bg-gray-50 rounded-md border">
                            {{ $grn->supplier?->address ?? $grn->supplier_address ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Items</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $grn->items->count() }} item(s) in this GRN</p>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-50">
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                    Item
                                    <small class="block text-gray-400 normal-case mt-1">Code & Name</small>
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                    Description
                                    <small class="block text-gray-400 normal-case mt-1">Item details</small>
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                    Quantity
                                    <small class="block text-gray-400 normal-case mt-1">Number of units</small>
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                    Rate
                                    <small class="block text-gray-400 normal-case mt-1">Cost per unit</small>
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                    Amount
                                    <small class="block text-gray-400 normal-case mt-1">Line amount</small>
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                    Disc %
                                    <small class="block text-gray-400 normal-case mt-1">Discount percent</small>
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                    Discount
                                    <small class="block text-gray-400 normal-case mt-1">Discount amount</small>
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                    Total
                                    <small class="block text-gray-400 normal-case mt-1">Line total</small>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($grn->items as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border border-gray-200">
                                        <div class="font-medium text-gray-900">
                                            {{ $item->item?->code ?? $item->item_code ?? 'N/A' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $item->item?->name ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 border border-gray-200 text-sm text-gray-700">
                                        {{ $item->description ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 border border-gray-200 text-sm text-right">
                                        {{ number_format($item->qty, 3) }}
                                    </td>
                                    <td class="px-4 py-3 border border-gray-200 text-sm text-right">
                                        LKR {{ number_format($item->rate, 2) }}
                                    </td>
                                    <td class="px-4 py-3 border border-gray-200 text-sm text-right">
                                        LKR {{ number_format($item->amount, 2) }}
                                    </td>
                                    <td class="px-4 py-3 border border-gray-200 text-sm text-right">
                                        {{ number_format($item->disc_percent, 2) }}%
                                    </td>
                                    <td class="px-4 py-3 border border-gray-200 text-sm text-right">
                                        LKR {{ number_format($item->disc_amount, 2) }}
                                    </td>
                                    <td class="px-4 py-3 border border-gray-200 text-sm text-right font-semibold">
                                        LKR {{ number_format($item->total, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                        <i class="fas fa-box-open text-gray-300 text-4xl mb-4"></i>
                                        <p>No items found in this GRN</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="bg-blue-50">
                            <tr>
                                <th colspan="2"
                                    class="px-4 py-4 border border-gray-200 text-left font-semibold text-gray-700">Totals
                                </th>
                                <th class="px-4 py-4 border border-gray-200 text-right font-semibold text-blue-700">
                                    {{ number_format($grn->items->sum('qty'), 3) }}
                                </th>
                                <th class="px-4 py-4 border border-gray-200"></th>
                                <th class="px-4 py-4 border border-gray-200 text-right font-semibold text-blue-700">
                                    LKR {{ number_format($grn->items->sum('amount'), 2) }}
                                </th>
                                <th class="px-4 py-4 border border-gray-200"></th>
                                <th class="px-4 py-4 border border-gray-200 text-right font-semibold text-orange-700">
                                    LKR {{ number_format($grn->items->sum('disc_amount'), 2) }}
                                </th>
                                <th class="px-4 py-4 border border-gray-200 text-right font-bold text-green-700">
                                    LKR {{ number_format($grn->items->sum('total'), 2) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Totals & Tax Section - Side by Side Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Left Half: Totals & Accounts -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-calculator mr-2 text-purple-500"></i>
                        Totals & Accounts
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                LKR Total Amount
                            </label>
                            <div class="p-3 bg-blue-50 rounded-md border border-blue-200 font-semibold text-blue-800">
                                LKR {{ number_format($grn->subtotal ?? $grn->items->sum('total'), 2) }}
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Account
                            </label>
                            <div class="p-3 bg-gray-50 rounded-md border">
                                {{ $grn->account?->name ?? 'N/A' }}
                                @if($grn->account)
                                    ({{ $grn->account->code }})
                                @endif
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Memo
                            </label>
                            <div class="p-3 bg-gray-50 rounded-md border min-h-[100px]">
                                {{ $grn->memo ?? 'No memo provided' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Half: Tax & Final Calculations -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-percentage mr-2 text-orange-500"></i>
                        Tax & Final Calculations
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Discount %
                                </label>
                                <div class="p-3 bg-gray-50 rounded-md border">
                                    {{ number_format($grn->discount_percent ?? 0, 2) }}%
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Discount Amount
                                </label>
                                <div class="p-3 bg-gray-50 rounded-md border">
                                    LKR {{ number_format($grn->discount_amount ?? 0, 2) }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Subtotal After Discount
                            </label>
                            <div class="p-3 bg-gray-50 rounded-md border">
                                LKR {{ number_format(($grn->subtotal ?? 0) - ($grn->discount_amount ?? 0), 2) }}
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    VAT %
                                </label>
                                <div class="p-3 bg-gray-50 rounded-md border">
                                    {{ number_format($grn->vat_percent ?? 0, 2) }}%
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    VAT Amount
                                </label>
                                <div class="p-3 bg-gray-50 rounded-md border">
                                    LKR {{ number_format($grn->vat_amount ?? 0, 2) }}
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <strong>Final Total</strong>
                            </label>
                            <div
                                class="p-4 bg-green-50 rounded-md border border-green-200 font-bold text-green-800 text-lg">
                                LKR {{ number_format($grn->total_amount ?? $grn->final_total ?? 0, 2) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Audit Information -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">
                    <i class="fas fa-info-circle mr-2 text-gray-500"></i>
                    Audit Information
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Created At
                        </label>
                        <div class="p-3 bg-gray-50 rounded-md border">
                            {{ $grn->created_at?->format('M d, Y g:i A') ?? 'N/A' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Updated At
                        </label>
                        <div class="p-3 bg-gray-50 rounded-md border">
                            {{ $grn->updated_at?->format('M d, Y g:i A') ?? 'N/A' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Created By
                        </label>
                        <div class="p-3 bg-gray-50 rounded-md border">
                            {{ $grn->user?->name ?? $grn->created_by ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection