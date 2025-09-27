@extends('layouts.app')

@section('title', 'Edit Item - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-edit mr-2 text-blue-600"></i>
                    Edit Item
                </h1>
                <p class="text-gray-600 mt-1">Update {{ $item->name }} information</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('items.show', $item) }}" class="btn-secondary">
                    <i class="fas fa-eye mr-2"></i>
                    View Item
                </a>
                <a href="{{ route('items.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Items
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('items.update', $item) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                        Basic Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label" for="name">Item Name *</label>
                            <input type="text" id="name" name="name"
                                class="form-input @error('name') border-red-500 @enderror"
                                value="{{ old('name', $item->name) }}" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="code">Item Code *</label>
                            <input type="text" id="code" name="code"
                                class="form-input @error('code') border-red-500 @enderror"
                                value="{{ old('code', $item->code) }}" required>
                            @error('code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="category">Category *</label>
                            <select id="category" name="category"
                                class="form-input @error('category') border-red-500 @enderror" required>
                                <option value="">Select Category</option>
                                <option value="raw_material" {{ old('category', $item->category) == 'raw_material' ? 'selected' : '' }}>Raw Material</option>
                                <option value="finished_goods" {{ old('category', $item->category) == 'finished_goods' ? 'selected' : '' }}>Finished Goods</option>
                                <option value="semi_finished" {{ old('category', $item->category) == 'semi_finished' ? 'selected' : '' }}>Semi Finished</option>
                                <option value="consumables" {{ old('category', $item->category) == 'consumables' ? 'selected' : '' }}>Consumables</option>
                                <option value="spare_parts" {{ old('category', $item->category) == 'spare_parts' ? 'selected' : '' }}>Spare Parts</option>
                                <option value="tools" {{ old('category', $item->category) == 'tools' ? 'selected' : '' }}>Tools</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="type">Type *</label>
                            <select id="type" name="type"
                                class="form-input @error('type') border-red-500 @enderror" required>
                                <option value="">Select Type</option>
                                <option value="product" {{ old('type', $item->type) == 'product' ? 'selected' : '' }}>Product</option>
                                <option value="service" {{ old('type', $item->type) == 'service' ? 'selected' : '' }}>Service</option>
                                <option value="asset" {{ old('type', $item->type) == 'asset' ? 'selected' : '' }}>Asset</option>
                                <option value="consumable" {{ old('type', $item->type) == 'consumable' ? 'selected' : '' }}>Consumable</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="brand">Brand</label>
                            <input type="text" id="brand" name="brand"
                                class="form-input @error('brand') border-red-500 @enderror"
                                value="{{ old('brand', $item->brand) }}">
                            @error('brand')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="model">Model</label>
                            <input type="text" id="model" name="model"
                                class="form-input @error('model') border-red-500 @enderror"
                                value="{{ old('model', $item->model) }}">
                            @error('model')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" name="description" rows="3"
                                class="form-input @error('description') border-red-500 @enderror"
                                placeholder="Brief description of the item">{{ old('description', $item->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label" for="specifications">Specifications</label>
                            <textarea id="specifications" name="specifications" rows="3"
                                class="form-input @error('specifications') border-red-500 @enderror"
                                placeholder="Technical specifications, dimensions, etc.">{{ old('specifications', $item->specifications) }}</textarea>
                            @error('specifications')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory Information -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-warehouse mr-2 text-green-600"></i>
                        Inventory Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="form-label" for="unit_of_measure">Unit of Measure *</label>
                            <input type="text" id="unit_of_measure" name="unit_of_measure"
                                class="form-input @error('unit_of_measure') border-red-500 @enderror"
                                value="{{ old('unit_of_measure', $item->unit_of_measure) }}" required>
                            @error('unit_of_measure')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="current_stock">Current Stock *</label>
                            <input type="number" id="current_stock" name="current_stock"
                                class="form-input @error('current_stock') border-red-500 @enderror"
                                value="{{ old('current_stock', $item->current_stock) }}" min="0" required>
                            @error('current_stock')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="minimum_stock_level">Minimum Stock Level *</label>
                            <input type="number" id="minimum_stock_level" name="minimum_stock_level"
                                class="form-input @error('minimum_stock_level') border-red-500 @enderror"
                                value="{{ old('minimum_stock_level', $item->minimum_stock_level) }}" min="0" required>
                            @error('minimum_stock_level')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="maximum_stock_level">Maximum Stock Level *</label>
                            <input type="number" id="maximum_stock_level" name="maximum_stock_level"
                                class="form-input @error('maximum_stock_level') border-red-500 @enderror"
                                value="{{ old('maximum_stock_level', $item->maximum_stock_level) }}" min="0" required>
                            @error('maximum_stock_level')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="reorder_point">Reorder Point *</label>
                            <input type="number" id="reorder_point" name="reorder_point"
                                class="form-input @error('reorder_point') border-red-500 @enderror"
                                value="{{ old('reorder_point', $item->reorder_point) }}" min="0" required>
                            @error('reorder_point')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="weight">Weight (kg)</label>
                            <input type="number" id="weight" name="weight" step="0.01"
                                class="form-input @error('weight') border-red-500 @enderror"
                                value="{{ old('weight', $item->weight) }}" min="0">
                            @error('weight')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 lg:col-span-3">
                            <label class="form-label" for="dimensions">Dimensions</label>
                            <input type="text" id="dimensions" name="dimensions"
                                class="form-input @error('dimensions') border-red-500 @enderror"
                                value="{{ old('dimensions', $item->dimensions) }}" placeholder="e.g., 10cm x 20cm x 5cm">
                            @error('dimensions')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing Information -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-dollar-sign mr-2 text-yellow-600"></i>
                        Pricing Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label" for="purchase_price">Purchase Price (Rs.)</label>
                            <input type="number" id="purchase_price" name="purchase_price" step="0.01"
                                class="form-input @error('purchase_price') border-red-500 @enderror"
                                value="{{ old('purchase_price', $item->purchase_price) }}" min="0">
                            @error('purchase_price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="selling_price">Selling Price (Rs.)</label>
                            <input type="number" id="selling_price" name="selling_price" step="0.01"
                                class="form-input @error('selling_price') border-red-500 @enderror"
                                value="{{ old('selling_price', $item->selling_price) }}" min="0">
                            @error('selling_price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Supplier Information -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-truck mr-2 text-purple-600"></i>
                        Supplier Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="form-label" for="supplier_name">Supplier Name</label>
                            <input type="text" id="supplier_name" name="supplier_name"
                                class="form-input @error('supplier_name') border-red-500 @enderror"
                                value="{{ old('supplier_name', $item->supplier_name) }}">
                            @error('supplier_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="supplier_contact">Supplier Contact</label>
                            <input type="text" id="supplier_contact" name="supplier_contact"
                                class="form-input @error('supplier_contact') border-red-500 @enderror"
                                value="{{ old('supplier_contact', $item->supplier_contact) }}">
                            @error('supplier_contact')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="supplier_email">Supplier Email</label>
                            <input type="email" id="supplier_email" name="supplier_email"
                                class="form-input @error('supplier_email') border-red-500 @enderror"
                                value="{{ old('supplier_email', $item->supplier_email) }}">
                            @error('supplier_email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-cogs mr-2 text-indigo-600"></i>
                        Additional Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="form-label" for="barcode">Barcode</label>
                            <input type="text" id="barcode" name="barcode"
                                class="form-input @error('barcode') border-red-500 @enderror"
                                value="{{ old('barcode', $item->barcode) }}">
                            @error('barcode')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="sku">SKU</label>
                            <input type="text" id="sku" name="sku"
                                class="form-input @error('sku') border-red-500 @enderror"
                                value="{{ old('sku', $item->sku) }}">
                            @error('sku')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="warranty_period">Warranty Period (months)</label>
                            <input type="number" id="warranty_period" name="warranty_period"
                                class="form-input @error('warranty_period') border-red-500 @enderror"
                                value="{{ old('warranty_period', $item->warranty_period) }}" min="0">
                            @error('warranty_period')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Active
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="is_serialized" name="is_serialized" value="1"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                {{ old('is_serialized', $item->is_serialized) ? 'checked' : '' }}>
                            <label for="is_serialized" class="ml-2 block text-sm text-gray-900">
                                Serialized Item
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="expiry_tracking" name="expiry_tracking" value="1"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                {{ old('expiry_tracking', $item->expiry_tracking) ? 'checked' : '' }}>
                            <label for="expiry_tracking" class="ml-2 block text-sm text-gray-900">
                                Track Expiry Date
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('items.show', $item) }}" class="btn-secondary">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    Update Item
                </button>
            </div>
        </form>
    </div>
@endsection
