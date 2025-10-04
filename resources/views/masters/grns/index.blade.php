@extends('layouts.app')

@section('title', 'Goods Received Notes - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-clipboard-check mr-2 text-blue-600"></i>
                    Goods Received Notes (GRN)
                </h1>
                <p class="text-gray-600 mt-1">Manage incoming goods and inventory receipts</p>
            </div>
            <a href="{{ route('grns.create') }}" class="btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Create New GRN
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-receipt text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total GRNs</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $grns->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-calendar-day text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">This Month</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $grns->where('date', '>=', now()->startOfMonth())->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <i class="fas fa-dollar-sign text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Value</p>
                        <p class="text-2xl font-bold text-gray-900">LKR {{ number_format($grns->sum('total'), 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-full">
                        <i class="fas fa-truck text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Unique Suppliers</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $grns->unique('supplier_id')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Advanced Filters -->
        <div class="bg-white rounded-lg shadow mb-6 border border-gray-200">
            <div class="p-4">
                <form method="GET" action="{{ route('grns.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <div class="relative">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="GRN No, Reference, Supplier..." class="form-input pl-10 w-full">
                            </div>
                        </div>

                        <!-- Date Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-input">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-input">
                        </div>

                        <!-- Supplier Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                            <select name="supplier_id" class="form-input">
                                <option value="">All Suppliers</option>
                                @foreach($grns->unique('supplier_id') as $grn)
                                    @if($grn->supplier)
                                        <option value="{{ $grn->supplier->id }}" {{ request('supplier_id') == $grn->supplier->id ? 'selected' : '' }}>
                                            {{ $grn->supplier->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="btn-secondary">
                            <i class="fas fa-search mr-2"></i>
                            Search
                        </button>
                        <a href="{{ route('grns.index') }}" class="btn-secondary">
                            <i class="fas fa-refresh mr-2"></i>
                            Reset
                        </a>
                        <button type="button" class="btn-secondary">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- GRN Documents List -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">GRN Documents</h3>
            </div>
            <div class="overflow-x-auto">
                @forelse($grns as $grn)
                    <div class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4">
                                        <!-- GRN Icon & Number -->
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-receipt text-blue-600 text-lg"></i>
                                            </div>
                                        </div>

                                        <!-- Main Info -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center space-x-3 mb-1">
                                                <h4 class="text-lg font-semibold text-gray-900">{{ $grn->grn_no }}</h4>
                                                @if($grn->reference_no)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        Ref: {{ $grn->reference_no }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="flex items-center space-x-4 text-sm text-gray-600">
                                                <span class="flex items-center">
                                                    <i class="fas fa-calendar mr-1"></i>
                                                    {{ $grn->date->format('M d, Y') }}
                                                </span>
                                                @if($grn->supplier)
                                                    <span class="flex items-center">
                                                        <i class="fas fa-truck mr-1"></i>
                                                        {{ $grn->supplier->name }}
                                                    </span>
                                                @endif
                                                @if($grn->site)
                                                    <span class="flex items-center">
                                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                                        {{ $grn->site->name }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Financial Info -->
                                        <div class="flex-shrink-0 text-right">
                                            <div class="text-lg font-bold text-gray-900">
                                                LKR {{ number_format($grn->total, 2) }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $grn->items->count() }} {{ Str::plural('item', $grn->items->count()) }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Details Row -->
                                    <div class="mt-3 grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                        <div>
                                            <span class="font-medium text-gray-700">GRN Date:</span>
                                            <span class="text-gray-600 ml-1">
                                                {{ $grn->grn_date ? $grn->grn_date->format('M d, Y') : 'Not specified' }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">Due Date:</span>
                                            <span class="text-gray-600 ml-1">
                                                {{ $grn->due_date ? $grn->due_date->format('M d, Y') : 'Not specified' }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-700">VAT Amount:</span>
                                            <span class="text-gray-600 ml-1">LKR {{ number_format($grn->vat_amount, 2) }}</span>
                                        </div>
                                    </div>

                                    @if($grn->memo)
                                        <div class="mt-2">
                                            <span class="inline-flex items-start">
                                                <i class="fas fa-sticky-note text-yellow-500 mr-2 mt-1"></i>
                                                <span class="text-sm text-gray-600">{{ $grn->memo }}</span>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex-shrink-0 ml-6">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('grns.show', $grn) }}"
                                            class="inline-flex items-center px-3 py-2 bg-green-100 hover:bg-green-200 text-green-700 text-sm font-medium rounded-lg transition-colors duration-200"
                                            title="View GRN">
                                            <i class="fas fa-eye mr-1"></i>
                                            View
                                        </a>
                                        <a href="{{ route('grns.edit', $grn) }}"
                                            class="inline-flex items-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-medium rounded-lg transition-colors duration-200"
                                            title="Edit GRN">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit
                                        </a>
                                        <button onclick="printGrn({{ $grn->id }})"
                                            class="inline-flex items-center px-3 py-2 bg-purple-100 hover:bg-purple-200 text-purple-700 text-sm font-medium rounded-lg transition-colors duration-200"
                                            title="Print GRN">
                                            <i class="fas fa-print mr-1"></i>
                                            Print
                                        </button>
                                        <form action="{{ route('grns.destroy', $grn) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this GRN?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium rounded-lg transition-colors duration-200"
                                                title="Delete GRN">
                                                <i class="fas fa-trash mr-1"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-clipboard-check text-gray-300 text-5xl mb-4"></i>
                            <h3 class="text-xl font-medium text-gray-900 mb-2">No GRNs found</h3>
                            <p class="text-gray-500 mb-6">Get started by creating your first Goods Received Note.</p>
                            <a href="{{ route('grns.create') }}" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i>
                                Create First GRN
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($grns->hasPages())
                <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            {{ $grns->withQueryString()->simplePaginate() }}
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing {{ $grns->firstItem() }} to {{ $grns->lastItem() }} of {{ $grns->total() }} results
                                </p>
                            </div>
                            <div>
                                {{ $grns->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            function printGrn(grnId) {
                // Implement print functionality
                window.open(`/purchasing/grns/${grnId}/print`, '_blank');
            }
        </script>
    @endpush
@endsection