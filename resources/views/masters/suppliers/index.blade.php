@extends('layouts.app')

@section('title', 'Suppliers - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-truck mr-2 text-blue-600"></i>
                    Suppliers
                </h1>
                <p class="text-gray-600 mt-1">Manage your suppliers and vendors</p>
            </div>
            <a href="{{ route('suppliers.create') }}" class="btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Add New Supplier
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-truck text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Suppliers</p>
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
                        <p class="text-sm font-medium text-gray-600">Active Suppliers</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['active'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <i class="fas fa-shield-alt text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Verified Suppliers</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['verified'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-full">
                        <i class="fas fa-star text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Preferred Suppliers</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['preferred'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow mb-6 border border-gray-200">
            <div class="p-4">
                <form method="GET" action="{{ route('suppliers.index') }}">
                    <div class="flex flex-col sm:flex-row sm:items-end gap-3">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search by name, code, company, contact..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="sm:w-40">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                                <option value="material" {{ request('category') == 'material' ? 'selected' : '' }}>Material</option>
                                <option value="service" {{ request('category') == 'service' ? 'selected' : '' }}>Service</option>
                                <option value="both" {{ request('category') == 'both' ? 'selected' : '' }}>Both</option>
                            </select>
                        </div>

                        <!-- Company Type Filter -->
                        <div class="sm:w-40">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Company Type</label>
                            <select name="company_type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="all" {{ request('company_type') == 'all' ? 'selected' : '' }}>All Types</option>
                                <option value="corporation" {{ request('company_type') == 'corporation' ? 'selected' : '' }}>Corporation</option>
                                <option value="partnership" {{ request('company_type') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                                <option value="sole_proprietorship" {{ request('company_type') == 'sole_proprietorship' ? 'selected' : '' }}>Sole Proprietorship</option>
                                <option value="llc" {{ request('company_type') == 'llc' ? 'selected' : '' }}>LLC</option>
                                <option value="other" {{ request('company_type') == 'other' ? 'selected' : '' }}>Other</option>
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
                                <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                                <option value="preferred" {{ request('status') == 'preferred' ? 'selected' : '' }}>Preferred</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                                <i class="fas fa-search mr-1"></i>
                                Search
                            </button>
                            @if(request()->hasAny(['search', 'category', 'company_type', 'status']))
                                <a href="{{ route('suppliers.index') }}"
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

        <!-- Suppliers Table -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Supplier
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Contact Info
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rating
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
                        @forelse($suppliers as $supplier)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-building text-blue-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $supplier->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $supplier->code }}</div>
                                            @if($supplier->company_name)
                                                <div class="text-xs text-gray-400">{{ $supplier->company_name }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($supplier->contact_person)
                                        <div class="text-sm text-gray-900">{{ $supplier->contact_person }}</div>
                                    @endif
                                    @if($supplier->email)
                                        <div class="text-sm text-gray-500">{{ $supplier->email }}</div>
                                    @endif
                                    @if($supplier->phone)
                                        <div class="text-xs text-gray-400">{{ $supplier->phone }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ ucwords(str_replace('_', ' ', $supplier->category)) }}</div>
                                    <div class="text-sm text-gray-500">{{ ucwords(str_replace('_', ' ', $supplier->company_type)) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($supplier->rating)
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $supplier->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                            @endfor
                                            <span class="ml-2 text-sm text-gray-500">({{ $supplier->rating }})</span>
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-400">Not rated</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-1">
                                        @if($supplier->is_active)
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
                                        @if($supplier->is_verified)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-shield-alt mr-1"></i>
                                                Verified
                                            </span>
                                        @endif
                                        @if($supplier->is_preferred)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                <i class="fas fa-star mr-1"></i>
                                                Preferred
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('suppliers.show', $supplier) }}"
                                            class="inline-flex items-center px-2 py-1 bg-green-100 hover:bg-green-200 text-green-700 text-xs font-medium rounded transition-colors duration-200"
                                            title="View Supplier Details">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('suppliers.edit', $supplier) }}"
                                            class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 text-xs font-medium rounded transition-colors duration-200"
                                            title="Edit Supplier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('suppliers.toggle-status', $supplier) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-600 hover:text-yellow-900 text-xs font-medium rounded transition-colors duration-200"
                                                title="{{ $supplier->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fas fa-toggle-{{ $supplier->is_active ? 'on' : 'off' }}"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Are you sure you want to delete this supplier?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this Supplier? This action cannot be undone.')"
                                                class="inline-flex items-center px-2 py-1 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded transition-colors duration-200"
                                                title="Delete Supplier">
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
                                        <i class="fas fa-truck text-gray-400 text-5xl mb-4"></i>
                                        <p class="text-gray-500 text-lg mb-2">No suppliers found</p>
                                        <p class="text-gray-400 text-sm mb-4">Get started by adding your first supplier</p>
                                        <a href="{{ route('suppliers.create') }}" class="btn-primary">
                                            <i class="fas fa-plus mr-2"></i>
                                            Add New Supplier
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($suppliers->hasPages())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        @if($suppliers->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                                Previous
                            </span>
                        @else
                            <a href="{{ $suppliers->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                Previous
                            </a>
                        @endif

                        @if($suppliers->hasMorePages())
                            <a href="{{ $suppliers->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
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
                                <span class="font-medium text-gray-900">{{ $suppliers->firstItem() }}</span>
                                to
                                <span class="font-medium text-gray-900">{{ $suppliers->lastItem() }}</span>
                                of
                                <span class="font-medium text-gray-900">{{ $suppliers->total() }}</span>
                                results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                {{-- Previous Page Link --}}
                                @if ($suppliers->onFirstPage())
                                    <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                @else
                                    <a href="{{ $suppliers->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($suppliers->getUrlRange(1, $suppliers->lastPage()) as $page => $url)
                                    @if ($page == $suppliers->currentPage())
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
                                @if ($suppliers->hasMorePages())
                                    <a href="{{ $suppliers->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
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
