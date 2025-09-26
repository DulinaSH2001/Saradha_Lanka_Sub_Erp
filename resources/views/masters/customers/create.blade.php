@extends('layouts.app')

@section('title', 'Create Customer - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-user-plus mr-2 text-green-600"></i>
                    Create New Customer
                </h1>
                <p class="text-gray-600 mt-1">Add a new customer to your database</p>
            </div>
            <a href="{{ route('customers.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Customers
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <form action="{{ route('customers.store') }}" method="POST" class="p-6">
                @csrf

                <!-- Basic Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Basic Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Customer Type -->
                        <div>
                            <label for="customer_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Customer Type <span class="text-red-500">*</span>
                            </label>
                            <select name="customer_type" id="customer_type" class="form-input" required>
                                <option value="">Select Customer Type</option>
                                <option value="company" {{ old('customer_type') === 'company' ? 'selected' : '' }}>Company
                                </option>
                                <option value="individual" {{ old('customer_type') === 'individual' ? 'selected' : '' }}>
                                    Individual</option>
                            </select>
                            @error('customer_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company/Customer Name -->
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Company/Customer Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}"
                                class="form-input" placeholder="Enter company or customer name" required>
                            @error('company_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contact Person -->
                        <div>
                            <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-2">
                                Contact Person
                            </label>
                            <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person') }}"
                                class="form-input" placeholder="Enter contact person name">
                            @error('contact_person')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" class="form-input" required>
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-phone mr-2 text-green-500"></i>
                        Contact Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-input"
                                placeholder="customer@example.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-input"
                                placeholder="+94 11 234 5678">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mobile -->
                        <div>
                            <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">
                                Mobile Number
                            </label>
                            <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-input"
                                placeholder="+94 77 123 4567">
                            @error('mobile')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-map-marker-alt mr-2 text-purple-500"></i>
                        Address Information
                    </h3>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Address
                            </label>
                            <textarea name="address" id="address" rows="3" class="form-input"
                                placeholder="Enter complete address">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- City -->
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                    City
                                </label>
                                <input type="text" name="city" id="city" value="{{ old('city') }}" class="form-input"
                                    placeholder="Colombo">
                                @error('city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Postal Code -->
                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">
                                    Postal Code
                                </label>
                                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}"
                                    class="form-input" placeholder="00100">
                                @error('postal_code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                    Country
                                </label>
                                <input type="text" name="country" id="country" value="{{ old('country', 'Sri Lanka') }}"
                                    class="form-input" placeholder="Sri Lanka">
                                @error('country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900  mb-4 pb-2 border-b border-gray-200 ">
                        <i class="fas fa-briefcase mr-2 text-orange-500"></i>
                        Business Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Credit Limit -->
                        <div>
                            <label for="credit_limit" class="block text-sm font-medium text-gray-700  mb-2">
                                Credit Limit (LKR)
                            </label>
                            <input type="number" name="credit_limit" id="credit_limit" value="{{ old('credit_limit') }}"
                                class="form-input" placeholder="0.00" step="0.01" min="0">
                            @error('credit_limit')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Terms -->
                        <div>
                            <label for="payment_terms_days" class="block text-sm font-medium text-gray-700  mb-2">
                                Payment Terms (Days)
                            </label>
                            <input type="number" name="payment_terms_days" id="payment_terms_days"
                                value="{{ old('payment_terms_days', 30) }}" class="form-input" placeholder="30" min="0"
                                max="365">
                            @error('payment_terms_days')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tax Number -->
                        <div>
                            <label for="tax_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Tax Number (VAT/TIN)
                            </label>
                            <input type="text" name="tax_number" id="tax_number" value="{{ old('tax_number') }}"
                                class="form-input" placeholder="123456789V">
                            @error('tax_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200 ">
                        <i class="fas fa-sticky-note mr-2 text-yellow-500"></i>
                        Additional Notes
                    </h3>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notes
                        </label>
                        <textarea name="notes" id="notes" rows="4" class="form-input"
                            placeholder="Any additional information about the customer...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 ">
                    <a href="{{ route('customers.index') }}" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i>
                        Create Customer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection