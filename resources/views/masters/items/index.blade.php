@extends('layouts.app')

@section('title', 'Items - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-boxes mr-2 text-blue-600"></i>
                    Items
                </h1>
                <p class="text-gray-600 mt-1">Manage your inventory items and products</p>
            </div>
            <a href="{{ route('items.create') }}" class="btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Add New Item
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-boxes text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Items</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Items</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['active'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Low Stock</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['low_stock'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-full">
                        <i class="fas fa-times-circle text-red-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Out of Stock</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['out_of_stock'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow mb-6 border border-gray-200">
            <div class="p-4">
                <form method="GET" action="{{ route('items.index') }}">
                    <div class="flex flex-col sm:flex-row sm:items-end gap-3">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search by name, code, brand, SKU..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="sm:w-40">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                                <option value="raw_material" {{ request('category') == 'raw_material' ? 'selected' : '' }}>Raw Material</option>
                                <option value="finished_goods" {{ request('category') == 'finished_goods' ? 'selected' : '' }}>Finished Goods</option>
                                <option value="semi_finished" {{ request('category') == 'semi_finished' ? 'selected' : '' }}>Semi Finished</option>
                                <option value="consumables" {{ request('category') == 'consumables' ? 'selected' : '' }}>Consumables</option>
                                <option value="spare_parts" {{ request('category') == 'spare_parts' ? 'selected' : '' }}>Spare Parts</option>
                                <option value="tools" {{ request('category') == 'tools' ? 'selected' : '' }}>Tools</option>
                            </select>
                        </div>

                        <!-- Type Filter -->
                        <div class="sm:w-40">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <select name="type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All Types</option>
                                <option value="product" {{ request('type') == 'product' ? 'selected' : '' }}>Product</option>
                                <option value="service" {{ request('type') == 'service' ? 'selected' : '' }}>Service</option>
                                <option value="asset" {{ request('type') == 'asset' ? 'selected' : '' }}>Asset</option>
                                <option value="consumable" {{ request('type') == 'consumable' ? 'selected' : '' }}>Consumable</option>
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div class="sm:w-40">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="" {{ request('status') == '' ? 'selected' : '' }}>All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="low_stock" {{ request('status') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                                <i class="fas fa-search mr-1"></i>
                                Search
                            </button>
                            @if(request()->hasAny(['search', 'category', 'type', 'status']))
                                <a href="{{ route('items.index') }}"
                                    class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                                    <i class="fas fa-times mr-1"></i>
                                    Clear
                                </a>
                            @endif
                            <button type="button"
                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                                <i class="fas fa-download mr-1"></i>
                                Export
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Items Table -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Item
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock Level
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-cube text-blue-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $item->code }}</div>
                                            @if($item->brand || $item->model)
                                                <div class="text-xs text-gray-400">
                                                    {{ $item->brand }}{{ $item->brand && $item->model ? ' - ' : '' }}{{ $item->model }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ ucwords(str_replace('_', ' ', $item->category)) }}</div>
                                    <div class="text-sm text-gray-500">{{ ucwords(str_replace('_', ' ', $item->type)) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->current_stock }} {{ $item->unit_of_measure }}</div>
                                    <div class="text-xs text-gray-500">Min: {{ $item->minimum_stock_level }}</div>
                                    @if($item->current_stock <= $item->minimum_stock_level)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-exclamation-circle mr-1"></i>
                                            Low Stock
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->selling_price)
                                        <div class="text-sm font-medium text-gray-900">{{ $item->formatted_selling_price }}</div>
                                    @endif
                                    @if($item->purchase_price)
                                        <div class="text-xs text-gray-500">Cost: {{ $item->formatted_purchase_price }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->is_active)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">

                                         <a href="{{ route('items.show', $item) }}"
                                                        class="inline-flex items-center px-2 py-1 bg-green-100 hover:bg-green-200  text-green-700 text-xs font-medium rounded transition-colors duration-200"
                                                        title="View Item Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                        <a href="{{ route('items.edit', $item) }}"
                                                        class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 text-xs font-medium rounded transition-colors duration-200"
                                                        title="Edit Item">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                        <form action="{{ route('items.toggle-status', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-600 hover:text-yellow-900 text-xs font-medium rounded transition-colors duration-200"
                                                    title="{{ $item->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fas fa-toggle-{{ $item->is_active ? 'on' : 'off' }}"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this Item? This action cannot be undone.')"
                                                    class="inline-flex items-center px-2 py-1 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded transition-colors duration-200"
                                                    title="Delete Site">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    <div class="flex flex-col items-center justify-center py-12">
                                        <i class="fas fa-boxes text-gray-400 text-5xl mb-4"></i>
                                        <p class="text-gray-500 text-lg mb-2">No items found</p>
                                        <p class="text-gray-400 text-sm mb-4">Get started by adding your first item</p>
                                        <a href="{{ route('items.create') }}" class="btn-primary">
                                            <i class="fas fa-plus mr-2"></i>
                                            Add New Item
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($items->hasPages())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        @if($items->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                                Previous
                            </span>
                        @else
                            <a href="{{ $items->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                Previous
                            </a>
                        @endif

                        @if($items->hasMorePages())
                            <a href="{{ $items->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                Next
                            </a>
                        @else
                            <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                                Next
                            </span>
                        @endif
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium text-gray-900">{{ $items->firstItem() }}</span>
                                to
                                <span class="font-medium text-gray-900">{{ $items->lastItem() }}</span>
                                of
                                <span class="font-medium text-gray-900">{{ $items->total() }}</span>
                                results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                {{-- Previous Page Link --}}
                                @if ($items->onFirstPage())
                                    <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                @else
                                    <a href="{{ $items->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                                    @if ($page == $items->currentPage())
                                        <span class="relative inline-flex items-center px-4 py-2 border border-blue-500 bg-blue-50 text-sm font-medium text-blue-600">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($items->hasMorePages())
                                    <a href="{{ $items->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-not-allowed">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
