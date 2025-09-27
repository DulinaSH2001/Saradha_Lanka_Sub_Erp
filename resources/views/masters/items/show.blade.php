@extends('layouts.app')

@section('title', 'Item Details - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-cube mr-2 text-blue-600"></i>
                    {{ $item->name }}
                </h1>
                <p class="text-gray-600 mt-1">Item Code: {{ $item->code }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('items.edit', $item) }}" class="btn-primary">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Item
                </a>
                <a href="{{ route('items.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Items
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Information -->
            <div class="lg:col-span-2">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                            Basic Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                                <p class="text-gray-900">{{ $item->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Item Code</label>
                                <p class="text-gray-900 font-mono">{{ $item->code }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <span
                                    class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucwords(str_replace('_', ' ', $item->category)) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                                <span
                                    class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                                    {{ ucwords(str_replace('_', ' ', $item->type)) }}
                                </span>
                            </div>
                            @if($item->brand)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                                    <p class="text-gray-900">{{ $item->brand }}</p>
                                </div>
                            @endif
                            @if($item->model)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                                    <p class="text-gray-900">{{ $item->model }}</p>
                                </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <span
                                    class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            @if($item->description)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <p class="text-gray-900">{{ $item->description }}</p>
                                </div>
                            @endif
                            @if($item->specifications)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Specifications</label>
                                    <p class="text-gray-900">{{ $item->specifications }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Inventory Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-warehouse mr-2 text-green-600"></i>
                            Inventory Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Unit of Measure</label>
                                <p class="text-gray-900">{{ $item->unit_of_measure }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Current Stock</label>
                                <p class="text-gray-900 flex items-center">
                                    <span
                                        class="text-2xl font-bold {{ $item->current_stock <= $item->minimum_stock_level ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $item->current_stock }}
                                    </span>
                                    <span class="ml-1 text-sm text-gray-500">{{ $item->unit_of_measure }}</span>
                                    @if($item->current_stock <= $item->minimum_stock_level)
                                        <span
                                            class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>
                                            Low Stock
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Minimum Stock Level</label>
                                <p class="text-gray-900">{{ $item->minimum_stock_level }} {{ $item->unit_of_measure }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Maximum Stock Level</label>
                                <p class="text-gray-900">{{ $item->maximum_stock_level }} {{ $item->unit_of_measure }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Reorder Point</label>
                                <p class="text-gray-900">{{ $item->reorder_point }} {{ $item->unit_of_measure }}</p>
                            </div>
                            @if($item->weight)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Weight</label>
                                    <p class="text-gray-900">{{ $item->weight }} kg</p>
                                </div>
                            @endif
                            @if($item->dimensions)
                                <div class="md:col-span-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Dimensions</label>
                                    <p class="text-gray-900">{{ $item->dimensions }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Pricing Information -->
                @if($item->purchase_price || $item->selling_price)
                    <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-dollar-sign mr-2 text-yellow-600"></i>
                                Pricing Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @if($item->purchase_price)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Purchase Price</label>
                                        <p class="text-2xl font-bold text-gray-900">{{ $item->formatted_purchase_price }}</p>
                                    </div>
                                @endif
                                @if($item->selling_price)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Selling Price</label>
                                        <p class="text-2xl font-bold text-gray-900">{{ $item->formatted_selling_price }}</p>
                                    </div>
                                @endif
                                @if($item->purchase_price && $item->selling_price)
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Margin</label>
                                        @php
                                            $margin = $item->selling_price - $item->purchase_price;
                                            $marginPercent = $item->purchase_price > 0 ? ($margin / $item->purchase_price) * 100 : 0;
                                        @endphp
                                        <p class="text-gray-900">
                                            Rs. {{ number_format($margin, 2) }}
                                            <span class="text-sm text-gray-500">({{ number_format($marginPercent, 1) }}%)</span>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Supplier Information -->
                @if($item->supplier_name || $item->supplier_contact || $item->supplier_email)
                    <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-truck mr-2 text-purple-600"></i>
                                Supplier Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @if($item->supplier_name)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Supplier Name</label>
                                        <p class="text-gray-900">{{ $item->supplier_name }}</p>
                                    </div>
                                @endif
                                @if($item->supplier_contact)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
                                        <p class="text-gray-900">{{ $item->supplier_contact }}</p>
                                    </div>
                                @endif
                                @if($item->supplier_email)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                        <p class="text-gray-900">{{ $item->supplier_email }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-bolt mr-2 text-yellow-600"></i>
                            Quick Actions
                        </h3>
                        <div class="space-y-3">
                            <a href="{{ route('items.edit', $item) }}"
                                class="w-full flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Item
                            </a>
                            <form action="{{ route('items.toggle-status', $item) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-2 text-sm font-medium text-white {{ $item->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} rounded-lg transition-colors duration-200">
                                    <i class="fas fa-toggle-{{ $item->is_active ? 'off' : 'on' }} mr-2"></i>
                                    {{ $item->is_active ? 'Deactivate' : 'Activate' }} Item
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Additional Details -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-cogs mr-2 text-indigo-600"></i>
                            Additional Details
                        </h3>
                        <div class="space-y-4">
                            @if($item->barcode)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Barcode</label>
                                    <p class="text-gray-900 font-mono text-sm">{{ $item->barcode }}</p>
                                </div>
                            @endif
                            @if($item->sku)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                                    <p class="text-gray-900 font-mono text-sm">{{ $item->sku }}</p>
                                </div>
                            @endif
                            @if($item->warranty_period)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Warranty Period</label>
                                    <p class="text-gray-900">{{ $item->warranty_period }} months</p>
                                </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Features</label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <i
                                            class="fas fa-{{ $item->is_serialized ? 'check-circle text-green-600' : 'times-circle text-gray-400' }} mr-2"></i>
                                        <span
                                            class="text-sm {{ $item->is_serialized ? 'text-gray-900' : 'text-gray-500' }}">Serialized
                                            Item</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i
                                            class="fas fa-{{ $item->expiry_tracking ? 'check-circle text-green-600' : 'times-circle text-gray-400' }} mr-2"></i>
                                        <span
                                            class="text-sm {{ $item->expiry_tracking ? 'text-gray-900' : 'text-gray-500' }}">Expiry
                                            Tracking</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stock Status -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-chart-bar mr-2 text-green-600"></i>
                            Stock Status
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">Current Stock</span>
                                    <span
                                        class="text-sm text-gray-900">{{ $item->current_stock }}/{{ $item->maximum_stock_level }}</span>
                                </div>
                                @php
                                    $stockPercent = $item->maximum_stock_level > 0 ? ($item->current_stock / $item->maximum_stock_level) * 100 : 0;
                                    $stockColor = $stockPercent <= 25 ? 'bg-red-500' : ($stockPercent <= 50 ? 'bg-yellow-500' : 'bg-green-500');
                                @endphp
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="{{ $stockColor }} h-2 rounded-full"
                                        style="width: {{ min($stockPercent, 100) }}%"></div>
                                </div>
                            </div>
                            @if($item->current_stock <= $item->minimum_stock_level)
                                <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                                        <span class="text-sm font-medium text-red-800">Low Stock Alert</span>
                                    </div>
                                    <p class="text-xs text-red-700 mt-1">Current stock is at or below minimum level</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Audit Information -->
        <div class="mt-6 bg-white rounded-lg shadow border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-history mr-2 text-gray-600"></i>
                    Audit Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Created</label>
                        <p class="text-gray-900">{{ $item->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Modified</label>
                        <p class="text-gray-900">{{ $item->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection