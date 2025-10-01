@extends('layouts.app')

@section('title', 'Supplier Details - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-building mr-2 text-blue-600"></i>
                    {{ $supplier->name }}
                </h1>
                <p class="text-gray-600 mt-1">Supplier Code: {{ $supplier->code }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn-primary">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Supplier
                </a>
                <a href="{{ route('suppliers.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Suppliers
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
                                <label class="block text-sm font-medium text-gray-700 mb-1">Supplier Name</label>
                                <p class="text-gray-900">{{ $supplier->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Supplier Code</label>
                                <p class="text-gray-900 font-mono">{{ $supplier->code }}</p>
                            </div>
                            @if($supplier->company_name)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                                    <p class="text-gray-900">{{ $supplier->company_name }}</p>
                                </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Company Type</label>
                                <span
                                    class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucwords(str_replace('_', ' ', $supplier->company_type)) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <span
                                    class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                                    {{ ucwords($supplier->category) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $supplier->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $supplier->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    @if($supplier->is_verified)
                                        <span
                                            class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Verified
                                        </span>
                                    @endif
                                    @if($supplier->is_preferred)
                                        <span
                                            class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Preferred
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if($supplier->rating)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star {{ $i <= $supplier->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                        <span class="ml-2 text-sm text-gray-600">({{ $supplier->rating }}/5)</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-address-book mr-2 text-green-600"></i>
                            Contact Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($supplier->contact_person)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Person</label>
                                    <p class="text-gray-900">{{ $supplier->contact_person }}</p>
                                </div>
                            @endif
                            @if($supplier->designation)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                                    <p class="text-gray-900">{{ $supplier->designation }}</p>
                                </div>
                            @endif
                            @if($supplier->email)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <p class="text-gray-900">
                                        <a href="mailto:{{ $supplier->email }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $supplier->email }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                            @if($supplier->phone)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <p class="text-gray-900">
                                        <a href="tel:{{ $supplier->phone }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $supplier->phone }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                            @if($supplier->mobile)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mobile</label>
                                    <p class="text-gray-900">
                                        <a href="tel:{{ $supplier->mobile }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $supplier->mobile }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                            @if($supplier->fax)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Fax</label>
                                    <p class="text-gray-900">{{ $supplier->fax }}</p>
                                </div>
                            @endif
                            @if($supplier->website)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                                    <p class="text-gray-900">
                                        <a href="{{ $supplier->website }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800">
                                            {{ $supplier->website }} <i class="fas fa-external-link-alt ml-1"></i>
                                        </a>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                @if($supplier->address_line_1 || $supplier->city || $supplier->state || $supplier->country)
                    <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-map-marker-alt mr-2 text-red-600"></i>
                                Address Information
                            </h3>
                            <div class="space-y-2">
                                @if($supplier->address_line_1)
                                    <p class="text-gray-900">{{ $supplier->address_line_1 }}</p>
                                @endif
                                @if($supplier->address_line_2)
                                    <p class="text-gray-900">{{ $supplier->address_line_2 }}</p>
                                @endif
                                @if($supplier->city || $supplier->state || $supplier->postal_code)
                                    <p class="text-gray-900">
                                        {{ $supplier->city }}{{ $supplier->city && ($supplier->state || $supplier->postal_code) ? ', ' : '' }}
                                        {{ $supplier->state }}{{ $supplier->state && $supplier->postal_code ? ' ' : '' }}
                                        {{ $supplier->postal_code }}
                                    </p>
                                @endif
                                @if($supplier->country)
                                    <p class="text-gray-900 font-medium">{{ $supplier->country }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Business Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-building mr-2 text-yellow-600"></i>
                            Business Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($supplier->tax_number)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tax Number</label>
                                    <p class="text-gray-900 font-mono">{{ $supplier->tax_number }}</p>
                                </div>
                            @endif
                            @if($supplier->registration_number)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Registration Number</label>
                                    <p class="text-gray-900 font-mono">{{ $supplier->registration_number }}</p>
                                </div>
                            @endif
                            @if($supplier->credit_limit)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Credit Limit</label>
                                    <p class="text-2xl font-bold text-gray-900">{{ $supplier->formatted_credit_limit }}</p>
                                </div>
                            @endif
                            @if($supplier->credit_period)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Credit Period</label>
                                    <p class="text-gray-900">{{ $supplier->credit_period }} days</p>
                                </div>
                            @endif
                            @if($supplier->discount_percentage)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Discount Percentage</label>
                                    <p class="text-gray-900">{{ $supplier->discount_percentage }}%</p>
                                </div>
                            @endif
                            @if($supplier->payment_terms)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Payment Terms</label>
                                    <p class="text-gray-900">{{ $supplier->payment_terms }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Banking Information -->
                @if($supplier->bank_name || $supplier->bank_account_number || $supplier->bank_routing_number)
                    <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-university mr-2 text-purple-600"></i>
                                Banking Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @if($supplier->bank_name)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Bank Name</label>
                                        <p class="text-gray-900">{{ $supplier->bank_name }}</p>
                                    </div>
                                @endif
                                @if($supplier->bank_account_number)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Account Number</label>
                                        <p class="text-gray-900 font-mono">{{ $supplier->bank_account_number }}</p>
                                    </div>
                                @endif
                                @if($supplier->bank_routing_number)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Routing Number</label>
                                        <p class="text-gray-900 font-mono">{{ $supplier->bank_routing_number }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Notes -->
                @if($supplier->notes)
                    <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-sticky-note mr-2 text-indigo-600"></i>
                                Notes
                            </h3>
                            <p class="text-gray-900 whitespace-pre-wrap">{{ $supplier->notes }}</p>
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
                            <a href="{{ route('suppliers.edit', $supplier) }}"
                                class="w-full flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Supplier
                            </a>
                            <form action="{{ route('suppliers.toggle-status', $supplier) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-2 text-sm font-medium text-white {{ $supplier->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} rounded-lg transition-colors duration-200">
                                    <i class="fas fa-toggle-{{ $supplier->is_active ? 'off' : 'on' }} mr-2"></i>
                                    {{ $supplier->is_active ? 'Deactivate' : 'Activate' }} Supplier
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Supplier Statistics -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-chart-line mr-2 text-green-600"></i>
                            Supplier Statistics
                        </h3>
                        <div class="space-y-4">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-blue-900">Total Orders</p>
                                        <p class="text-2xl font-bold text-blue-600">0</p>
                                    </div>
                                    <i class="fas fa-shopping-cart text-blue-600 text-2xl"></i>
                                </div>
                            </div>
                            <div class="bg-green-50 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-green-900">Total Amount</p>
                                        <p class="text-2xl font-bold text-green-600">Rs. 0</p>
                                    </div>
                                    <i class="fas fa-money-bill-wave text-green-600 text-2xl"></i>
                                </div>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-purple-900">Last Order</p>
                                        <p class="text-sm font-medium text-purple-600">No orders yet</p>
                                    </div>
                                    <i class="fas fa-clock text-purple-600 text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verification Status -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-shield-alt mr-2 text-blue-600"></i>
                            Verification Status
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Active Status</span>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $supplier->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <i class="fas fa-{{ $supplier->is_active ? 'check' : 'times' }} mr-1"></i>
                                    {{ $supplier->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Verified</span>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $supplier->is_verified ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    <i class="fas fa-{{ $supplier->is_verified ? 'check' : 'times' }} mr-1"></i>
                                    {{ $supplier->is_verified ? 'Verified' : 'Not Verified' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Preferred</span>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $supplier->is_preferred ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800' }}">
                                    <i class="fas fa-{{ $supplier->is_preferred ? 'star' : 'star-o' }} mr-1"></i>
                                    {{ $supplier->is_preferred ? 'Preferred' : 'Standard' }}
                                </span>
                            </div>
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
                        <p class="text-gray-900">{{ $supplier->created_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Modified</label>
                        <p class="text-gray-900">{{ $supplier->updated_at->format('M d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection