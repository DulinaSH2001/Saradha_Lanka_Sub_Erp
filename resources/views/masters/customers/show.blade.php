@extends('layouts.app')

@section('title', 'Customer Details - ' . $customer->display_name)

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <div
                    class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-4">
                    <span class="text-white font-bold text-lg">{{ $customer->initials }}</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $customer->display_name }}
                    </h1>
                    <p class="text-gray-600">{{ $customer->customer_code }}</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('customers.edit', $customer) }}" class="btn-primary">
                    <i class="fas fa-edit mr-2"></i>
                    Edit
                </a>
                <a href="{{ route('customers.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to List
                </a>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6" role="alert">
                <div class="flex">
                    <i class="fas fa-check-circle mr-2 mt-0.5"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Customer Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                            Basic Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Customer
                                    Code</label>
                                <p class="mt-1 text-sm text-gray-900 font-mono">
                                    {{ $customer->customer_code }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Customer
                                    Type</label>
                                <p class="mt-1 text-sm text-gray-900 capitalize">
                                    {{ $customer->customer_type }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Company
                                    Name</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $customer->company_name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Contact
                                    Person</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $customer->contact_person ?: 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Status</label>

                                    @php
                                        $status = strtolower($customer->status);
                                        $statusClasses = [
                                            'active' => 'bg-green-100 text-green-800',
                                            'inactive' => 'bg-red-100 text-red-800',
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                        ];
                                    @endphp
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full mt-1 {{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($status) }}
                                    </span>

                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Created</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $customer->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-phone mr-2 text-green-500"></i>
                            Contact Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    @if($customer->email)
                                        <a href="mailto:{{ $customer->email }}"
                                            class="text-blue-600 hover:text-blue-800">{{ $customer->email }}</a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Phone</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    @if($customer->phone)
                                        <a href="tel:{{ $customer->phone }}"
                                            class="text-blue-600 hover:text-blue-800">{{ $customer->phone }}</a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Mobile</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    @if($customer->mobile)
                                        <a href="tel:{{ $customer->mobile }}"
                                            class="text-blue-600 hover:text-blue-800">{{ $customer->mobile }}</a>
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-map-marker-alt mr-2 text-purple-500"></i>
                            Address Information
                        </h3>
                    </div>
                    <div class="p-6">
                        @if($customer->address || $customer->city || $customer->postal_code || $customer->country)
                            <div class="space-y-4">
                                @if($customer->address)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500">Address</label>
                                        <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">
                                            {{ $customer->address }}</p>
                                    </div>
                                @endif

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    @if($customer->city)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">City</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $customer->city }}</p>
                                        </div>
                                    @endif

                                    @if($customer->postal_code)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500">Postal
                                                Code</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $customer->postal_code }}</p>
                                        </div>
                                    @endif

                                    @if($customer->country)
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-500">Country</label>
                                            <p class="mt-1 text-sm text-gray-900">{{ $customer->country }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500">No address information provided</p>
                        @endif
                    </div>
                </div>

                <!-- Notes -->
                @if($customer->notes)
                    <div class="bg-white rounded-lg shadow border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <i class="fas fa-sticky-note mr-2 text-yellow-500"></i>
                                Notes
                            </h3>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-900 whitespace-pre-line">{{ $customer->notes }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Business Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-briefcase mr-2 text-orange-500"></i>
                            Business Info
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Credit Limit</label>
                            <p class="mt-1 text-lg font-semibold text-gray-900">
                                @if($customer->credit_limit)
                                    LKR {{ number_format($customer->credit_limit, 2) }}
                                @else
                                    <span class="text-gray-500 text-sm">Not set</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Payment Terms</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $customer->payment_terms_days }} days
                            </p>
                        </div>
                        @if($customer->tax_number)
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Tax Number</label>
                                <p class="mt-1 text-sm text-gray-900 font-mono">{{ $customer->tax_number }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-lightning-bolt mr-2 text-yellow-500"></i>
                            Quick Actions
                        </h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('customers.edit', $customer) }}"
                            class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <i class="fas fa-edit text-blue-600 mr-3"></i>
                            <span class="text-blue-700 font-medium">Edit Customer</span>
                        </a>

                        @if($customer->email)
                            <a href="mailto:{{ $customer->email }}"
                                class="flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                                <i class="fas fa-envelope text-green-600 mr-3"></i>
                                <span class="text-green-700 font-medium">Send Email</span>
                            </a>
                        @endif

                        @if($customer->phone || $customer->mobile)
                            <a href="tel:{{ $customer->phone ?: $customer->mobile }}"
                                class="flex items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                                <i class="fas fa-phone text-purple-600 mr-3"></i>
                                <span class="text-purple-700 font-medium">Call Customer</span>
                            </a>
                        @endif

                        <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this customer? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full flex items-center p-3 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                <i class="fas fa-trash text-red-600 mr-3"></i>
                                <span class="text-red-700 font-medium">Delete Customer</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
