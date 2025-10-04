@extends('layouts.app')

@section('title', 'Create GRN - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-plus-circle mr-2 text-green-600"></i>
                    Create Goods Received Note
                </h1>
                <p class="text-gray-600 mt-1">Record incoming goods and inventory receipts</p>
            </div>
            <a href="{{ route('grns.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to GRNs
            </a>
        </div>

        <!-- GRN Form -->
        <form action="{{ route('grns.store') }}" method="POST" id="grn-form">
            @csrf

            <!-- Vendor & Order Details Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4">
                <div class="px-4 py-2 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base font-semibold text-gray-900">
                        <i class="fas fa-truck mr-2 text-blue-500"></i>
                        Vendor & Order Details
                    </h3>
                </div>
                <div class="p-4">
                    <!-- Row 1: Supplier, Site, GRN No -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <!-- Supplier Selection -->
                        <div>
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Supplier Name <span class="text-red-500">*</span>
                            </label>
                            <select id="supplier_id" name="supplier_id" class="form-input @error('supplier_id') border-red-300 @enderror" required onchange="loadSupplierAddress()">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" data-address="{{ $supplier->address_line_1 }}, {{ $supplier->city }}, {{ $supplier->country }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Site Selection -->
                        <div>
                            <label for="site_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Site
                            </label>
                            <select id="site_id" name="site_id" class="form-input @error('site_id') border-red-300 @enderror">
                                <option value="">Select Site</option>
                                @foreach($sites as $site)
                                    <option value="{{ $site->id }}" {{ old('site_id') == $site->id ? 'selected' : '' }}>
                                        {{ $site->name }} ({{ $site->code }})
                                    </option>
                                @endforeach
                            </select>
                            @error('site_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- GRN No -->
                        <div>
                            <label for="grn_no" class="block text-sm font-medium text-gray-700 mb-1">
                                GRN No <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="grn_no" name="grn_no"
                                class="form-input @error('grn_no') border-red-300 @enderror"
                                value="{{ old('grn_no', 'GRN-' . date('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT)) }}" placeholder="Enter GRN number" required>
                            @error('grn_no')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 2: Date, Reference No, Invoice Date -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <!-- supplier address -->
                         <div>
                            <label for="supplier_address" class="block text-sm font-medium text-gray-700 mb-1">
                                Supplier Address
                            </label>
                            <textarea id="supplier_address" name="supplier_address" class="form-input" rows="2"
                                placeholder="Supplier address will be loaded automatically" readonly>{{ old('supplier_address') }}</textarea>
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
                                Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="date" name="date"
                                class="form-input @error('date') border-red-300 @enderror"
                                value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Reference No -->
                        <div>
                            <label for="reference_no" class="block text-sm font-medium text-gray-700 mb-1">
                                Reference No
                            </label>
                            <input type="text" id="reference_no" name="reference_no"
                                class="form-input @error('reference_no') border-red-300 @enderror"
                                value="{{ old('reference_no') }}" placeholder="Enter reference number">
                            @error('reference_no')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>

                    <!-- Row 3: Due Date, Supplier Address -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Due Date -->
                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Due Date
                            </label>
                            <input type="date" id="due_date" name="due_date"
                                class="form-input @error('due_date') border-red-300 @enderror"
                                value="{{ old('due_date', date('Y-m-d')) }}">
                            @error('due_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- GRN Date -->
                        <div>
                            <label for="grn_date" class="block text-sm font-medium text-gray-700 mb-1">
                                GRN Date<span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="grn_date" name="grn_date"
                                class="form-input @error('grn_date') border-red-300 @enderror"
                                value="{{ old('grn_date', date('Y-m-d') ) }}" required>
                            @error('grn_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <!-- Items Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4">
                <div class="px-4 py-2 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Items</h3>
                    <p class="text-xs text-gray-600 mt-1">Add and manage items for this GRN</p>
                </div>
                <div class="p-3">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse" id="items-table">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Item
                                        <small class="block text-gray-400 normal-case mt-1">Select from inventory</small>
                                    </th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Description
                                        <small class="block text-gray-400 normal-case mt-1">Item details</small>
                                    </th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Quantity
                                        <small class="block text-gray-400 normal-case mt-1">Number of units</small>
                                    </th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Rate
                                        <small class="block text-gray-400 normal-case mt-1">Cost per unit</small>
                                    </th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Amount
                                        <small class="block text-gray-400 normal-case mt-1">Line amount</small>
                                    </th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Disc %
                                        <small class="block text-gray-400 normal-case mt-1">Discount percent</small>
                                    </th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Discount
                                        <small class="block text-gray-400 normal-case mt-1">Discount amount</small>
                                    </th>
                                    <th class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Total
                                        <small class="block text-gray-400 normal-case mt-1">Line total</small>
                                    </th>
                                    <th class="px-2 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Action
                                        <small class="block text-gray-400 normal-case mt-1">Remove item</small>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="items-tbody">
                                <!-- Initial row -->
                                <tr class="hover:bg-gray-50 item-row">
                                    <td class="px-2 py-2 border border-gray-200">
                                        <select name="items[0][item_id]" class="form-input text-xs item-select"
                                            onchange="loadItemDetails(this, 0)">
                                            <option value="">Select Item</option>
                                            @foreach($items as $item)
                                                <option value="{{ $item->id }}" data-code="{{ $item->code }}"
                                                    data-description="{{ $item->name }}"
                                                    data-rate="{{ $item->purchase_price ?? 0 }}">
                                                    {{ $item->code }} - {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="items[0][item_code]" class="item-code-input">
                                    </td>
                                    <td class="px-2 py-2 border border-gray-200">
                                        <input type="text" name="items[0][description]" class="form-input text-xs description-input"
                                            placeholder="Item description">
                                    </td>
                                    <td class="px-2 py-2 border border-gray-200">
                                        <input type="number" name="items[0][qty]" class="form-input text-xs text-right qty-input" step="0.001"
                                            min="0" value="0" onchange="calculateRowTotal(0)">
                                    </td>
                                    <td class="px-2 py-2 border border-gray-200">
                                        <input type="number" name="items[0][rate]" class="form-input text-xs text-right rate-input" step="0.01"
                                            min="0" value="0" onchange="calculateRowTotal(0)">
                                    </td>
                                    <td class="px-2 py-2 border border-gray-200">
                                        <input type="number" name="items[0][amount]" class="form-input text-xs text-right bg-gray-50 amount-input" readonly>
                                    </td>
                                    <td class="px-2 py-2 border border-gray-200">
                                        <input type="number" name="items[0][disc_percent]"
                                            class="form-input text-xs text-right disc-percent-input" step="0.01" min="0" max="100" value="0"
                                            onchange="calculateRowTotal(0)">
                                    </td>
                                    <td class="px-2 py-2 border border-gray-200">
                                        <input type="number" name="items[0][disc_amount]" class="form-input text-xs text-right bg-gray-50 disc-amount-input"
                                            readonly>
                                    </td>
                                    <td class="px-2 py-2 border border-gray-200">
                                        <input type="number" name="items[0][total]" class="form-input text-xs text-right bg-gray-50 total-input" readonly>
                                    </td>
                                    <td class="px-2 py-2 border border-gray-200 text-center">
                                        <button type="button" onclick="removeItemRow(this)"
                                            class="inline-flex items-center px-3 py-2 bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium rounded transition-colors duration-150">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-blue-50">
                                <tr>
                                    <th colspan="2" class="px-2 py-2 border border-gray-200 text-left font-semibold text-gray-700 text-xs">Totals</th>
                                    <th class="px-2 py-2 border border-gray-200 text-right font-semibold text-blue-700 text-xs">
                                        <span id="total-qty">0</span>
                                    </th>
                                    <th class="px-2 py-2 border border-gray-200"></th>
                                    <th class="px-2 py-2 border border-gray-200 text-right font-semibold text-blue-700 text-xs">
                                        <span id="total-amount">0.00</span>
                                    </th>
                                    <th class="px-2 py-2 border border-gray-200"></th>
                                    <th class="px-2 py-2 border border-gray-200 text-right font-semibold text-orange-700 text-xs">
                                        <span id="total-discount">0.00</span>
                                    </th>
                                    <th class="px-2 py-2 border border-gray-200 text-right font-bold text-green-700 text-xs">
                                        <span id="total-line-total">0.00</span>
                                    </th>
                                    <th class="px-2 py-2 border border-gray-200"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Add Item Button -->
                    <div class="mt-3">
                        <button type="button" onclick="addItemRow()"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded transition-colors duration-150">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add New Item
                        </button>
                    </div>
                </div>
            </div>

            <!-- Totals & Tax Section - Side by Side Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
                <!-- Left Half: Totals & Accounts -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-4 py-2 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-base font-semibold text-gray-900">
                            <i class="fas fa-calculator mr-2 text-purple-500"></i>
                            Totals & Accounts
                        </h3>
                    </div>
                    <div class="p-4">
                        <div class="space-y-3">
                            <div>
                                <label for="subtotal_display" class="block text-sm font-medium text-gray-700 mb-1">
                                    LKR Total Amount
                                </label>
                                <input type="text" id="subtotal_display" class="form-input" readonly>
                            </div>

                            <div>
                                <label for="account_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Account
                                </label>
                                <select id="account_id" name="account_id"
                                    class="form-input @error('account_id') border-red-300 @enderror">
                                    <option value="">Select Account</option>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                            {{ $account->name }} ({{ $account->code }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('account_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="memo" class="block text-sm font-medium text-gray-700 mb-1">
                                    Memo
                                </label>
                                <textarea id="memo" name="memo" class="form-input @error('memo') border-red-300 @enderror"
                                    rows="3" placeholder="Additional notes or comments">{{ old('memo') }}</textarea>
                                @error('memo')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Half: Tax & Final Calculations -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-4 py-2 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-base font-semibold text-gray-900">
                            <i class="fas fa-percentage mr-2 text-orange-500"></i>
                            Tax & Final Calculations
                        </h3>
                    </div>
                    <div class="p-4">
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label for="discount_percent" class="block text-sm font-medium text-gray-700 mb-1">
                                        Discount %
                                    </label>
                                    <input type="number" id="discount_percent" name="discount_percent" class="form-input"
                                        step="0.01" min="0" max="100" value="{{ old('discount_percent', 0) }}"
                                        onchange="calculateFinalTotal()">
                                </div>

                                <div>
                                    <label for="discount_amount" class="block text-sm font-medium text-gray-700 mb-1">
                                        Discount Amount
                                    </label>
                                    <input type="number" id="discount_amount" name="discount_amount" class="form-input" step="0.01"
                                        min="0" value="{{ old('discount_amount', 0) }}" onchange="calculateFinalTotal()">
                                </div>
                            </div>

                            <div>
                                <label for="subtotal_after_discount" class="block text-sm font-medium text-gray-700 mb-1">
                                    Subtotal After Discount
                                </label>
                                <input type="text" id="subtotal_after_discount" class="form-input bg-gray-50" readonly>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label for="vat_percent" class="block text-sm font-medium text-gray-700 mb-1">
                                        VAT %
                                    </label>
                                    <input type="number" id="vat_percent" name="vat_percent" class="form-input" step="0.01" min="0"
                                        value="{{ old('vat_percent', 0) }}" onchange="calculateFinalTotal()">
                                </div>

                                <div>
                                    <label for="vat_amount" class="block text-sm font-medium text-gray-700 mb-1">
                                        VAT Amount
                                    </label>
                                    <input type="number" id="vat_amount" name="vat_amount" class="form-input bg-gray-50" readonly>
                                </div>
                            </div>

                            <div>
                                <label for="final_total" class="block text-sm font-medium text-gray-700 mb-1">
                                    <strong>Final Total</strong>
                                </label>
                                <input type="text" id="final_total" class="form-input font-bold bg-green-50" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-3">
                            <button type="submit" name="action" value="save_new"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-save mr-2"></i>
                                Save & New
                            </button>
                            <button type="submit" name="action" value="save_close"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-check mr-2"></i>
                                Save & Close
                            </button>
                            <button type="button" onclick="resetForm()"
                                class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-undo mr-2"></i>
                                Reset
                            </button>
                        </div>
                        <a href="{{ route('grns.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            let itemRowCount = 1;

            function loadSupplierAddress() {
                const select = document.getElementById('supplier_id');
                const addressField = document.getElementById('supplier_address');
                const selectedOption = select.options[select.selectedIndex];

                if (selectedOption.value) {
                    addressField.value = selectedOption.getAttribute('data-address') || '';
                } else {
                    addressField.value = '';
                }
            }

            function loadItemDetails(select, rowIndex) {
                const selectedOption = select.options[select.selectedIndex];
                const row = select.closest('.item-row');

                if (selectedOption.value) {
                    row.querySelector('.item-code-input').value = selectedOption.getAttribute('data-code') || '';
                    row.querySelector('.description-input').value = selectedOption.getAttribute('data-description') || '';
                    row.querySelector('.rate-input').value = selectedOption.getAttribute('data-rate') || '0';
                    calculateRowTotal(rowIndex);
                } else {
                    row.querySelector('.item-code-input').value = '';
                    row.querySelector('.description-input').value = '';
                    row.querySelector('.rate-input').value = '0';
                    calculateRowTotal(rowIndex);
                }
            }

            function calculateRowTotal(rowIndex) {
                const row = document.querySelector(`.item-row:nth-child(${rowIndex + 1})`);
                if (!row) return;

                const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
                const rate = parseFloat(row.querySelector('.rate-input').value) || 0;
                const discPercent = parseFloat(row.querySelector('.disc-percent-input').value) || 0;

                const amount = qty * rate;
                const discAmount = (amount * discPercent) / 100;
                const total = amount - discAmount;

                row.querySelector('.amount-input').value = amount.toFixed(2);
                row.querySelector('.disc-amount-input').value = discAmount.toFixed(2);
                row.querySelector('.total-input').value = total.toFixed(2);

                calculateTableTotals();
            }

            function calculateTableTotals() {
                let totalQty = 0;
                let totalAmount = 0;
                let totalDiscount = 0;
                let totalLineTotal = 0;

                document.querySelectorAll('.item-row').forEach(row => {
                    totalQty += parseFloat(row.querySelector('.qty-input').value) || 0;
                    totalAmount += parseFloat(row.querySelector('.amount-input').value) || 0;
                    totalDiscount += parseFloat(row.querySelector('.disc-amount-input').value) || 0;
                    totalLineTotal += parseFloat(row.querySelector('.total-input').value) || 0;
                });

                document.getElementById('total-qty').textContent = totalQty.toFixed(3);
                document.getElementById('total-amount').textContent = totalAmount.toFixed(2);
                document.getElementById('total-discount').textContent = totalDiscount.toFixed(2);
                document.getElementById('total-line-total').textContent = totalLineTotal.toFixed(2);

                document.getElementById('subtotal_display').value = 'LKR ' + totalAmount.toFixed(2);

                calculateFinalTotal();
            }

            function calculateFinalTotal() {
                const totalAmount = parseFloat(document.getElementById('total-amount').textContent) || 0;
                const discountPercent = parseFloat(document.getElementById('discount_percent').value) || 0;
                let discountAmount = parseFloat(document.getElementById('discount_amount').value) || 0;
                const vatPercent = parseFloat(document.getElementById('vat_percent').value) || 0;

                // Calculate discount
                if (discountPercent > 0 && discountAmount === 0) {
                    discountAmount = (totalAmount * discountPercent) / 100;
                    document.getElementById('discount_amount').value = discountAmount.toFixed(2);
                }

                const subtotalAfterDiscount = totalAmount - discountAmount;
                const vatAmount = (subtotalAfterDiscount * vatPercent) / 100;
                const finalTotal = subtotalAfterDiscount + vatAmount;

                document.getElementById('subtotal_after_discount').value = 'LKR ' + subtotalAfterDiscount.toFixed(2);
                document.getElementById('vat_amount').value = vatAmount.toFixed(2);
                document.getElementById('final_total').value = 'LKR ' + finalTotal.toFixed(2);
            }

            function addItemRow() {
                const tbody = document.getElementById('items-tbody');
                const newRow = tbody.children[0].cloneNode(true);

                // Update input names and reset values
                newRow.querySelectorAll('input, select').forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace('[0]', `[${itemRowCount}]`));
                    }
                    if (input.type === 'select-one') {
                        input.selectedIndex = 0;
                    } else {
                        input.value = input.type === 'number' ? '0' : '';
                    }
                });

                // Update onchange events
                newRow.querySelector('.item-select').setAttribute('onchange', `loadItemDetails(this, ${itemRowCount})`);
                newRow.querySelector('.qty-input').setAttribute('onchange', `calculateRowTotal(${itemRowCount})`);
                newRow.querySelector('.rate-input').setAttribute('onchange', `calculateRowTotal(${itemRowCount})`);
                newRow.querySelector('.disc-percent-input').setAttribute('onchange', `calculateRowTotal(${itemRowCount})`);

                tbody.appendChild(newRow);
                itemRowCount++;
            }

            function removeItemRow(button) {
                const tbody = document.getElementById('items-tbody');
                if (tbody.children.length > 1) {
                    button.closest('.item-row').remove();
                    calculateTableTotals();
                }
            }

            function resetForm() {
                if (confirm('Are you sure you want to reset the form? All data will be lost.')) {
                    document.getElementById('grn-form').reset();
                    // Reset item table to single row
                    const tbody = document.getElementById('items-tbody');
                    while (tbody.children.length > 1) {
                        tbody.removeChild(tbody.lastChild);
                    }
                    calculateTableTotals();
                }
            }

            // Initialize calculations on page load
            document.addEventListener('DOMContentLoaded', function () {
                calculateTableTotals();
            });
        </script>
    @endpush
@endsection
