@extends('layouts.app')

@section('title', 'Add New Supplier - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-plus mr-2 text-blue-600"></i>
                    Add New Supplier
                </h1>
                <p class="text-gray-600 mt-1">Create a new supplier or vendor</p>
            </div>
            <a href="{{ route('suppliers.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Suppliers
            </a>
        </div>

        <form method="POST" action="{{ route('suppliers.store') }}" class="space-y-6">
            @csrf

            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                        Basic Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label" for="name">Supplier Name *</label>
                            <input type="text" id="name" name="name"
                                class="form-input @error('name') border-red-500 @enderror"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="code">Supplier Code *</label>
                            <input type="text" id="code" name="code"
                                class="form-input @error('code') border-red-500 @enderror"
                                value="{{ old('code') }}" placeholder="e.g., SUP-001" required>
                            @error('code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="company_name">Company Name</label>
                            <input type="text" id="company_name" name="company_name"
                                class="form-input @error('company_name') border-red-500 @enderror"
                                value="{{ old('company_name') }}">
                            @error('company_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="company_type">Company Type *</label>
                            <select id="company_type" name="company_type"
                                class="form-input @error('company_type') border-red-500 @enderror" required>
                                <option value="">Select Company Type</option>
                                <option value="corporation" {{ old('company_type') == 'corporation' ? 'selected' : '' }}>Corporation</option>
                                <option value="partnership" {{ old('company_type') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                                <option value="sole_proprietorship" {{ old('company_type') == 'sole_proprietorship' ? 'selected' : '' }}>Sole Proprietorship</option>
                                <option value="llc" {{ old('company_type') == 'llc' ? 'selected' : '' }}>LLC</option>
                                <option value="other" {{ old('company_type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('company_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="category">Category *</label>
                            <select id="category" name="category"
                                class="form-input @error('category') border-red-500 @enderror" required>
                                <option value="">Select Category</option>
                                <option value="material" {{ old('category') == 'material' ? 'selected' : '' }}>Material</option>
                                <option value="service" {{ old('category') == 'service' ? 'selected' : '' }}>Service</option>
                                <option value="both" {{ old('category') == 'both' ? 'selected' : '' }}>Both</option>
                            </select>
                            @error('category')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="rating">Rating</label>
                            <select id="rating" name="rating"
                                class="form-input @error('rating') border-red-500 @enderror">
                                <option value="">Select Rating</option>
                                <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 Star</option>
                                <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 Stars</option>
                                <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 Stars</option>
                                <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                                <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                            </select>
                            @error('rating')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-address-book mr-2 text-green-600"></i>
                        Contact Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label" for="contact_person">Contact Person</label>
                            <input type="text" id="contact_person" name="contact_person"
                                class="form-input @error('contact_person') border-red-500 @enderror"
                                value="{{ old('contact_person') }}">
                            @error('contact_person')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="designation">Designation</label>
                            <input type="text" id="designation" name="designation"
                                class="form-input @error('designation') border-red-500 @enderror"
                                value="{{ old('designation') }}">
                            @error('designation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-input @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" id="phone" name="phone"
                                class="form-input @error('phone') border-red-500 @enderror"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="mobile">Mobile</label>
                            <input type="text" id="mobile" name="mobile"
                                class="form-input @error('mobile') border-red-500 @enderror"
                                value="{{ old('mobile') }}">
                            @error('mobile')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="fax">Fax</label>
                            <input type="text" id="fax" name="fax"
                                class="form-input @error('fax') border-red-500 @enderror"
                                value="{{ old('fax') }}">
                            @error('fax')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label" for="website">Website</label>
                            <input type="url" id="website" name="website"
                                class="form-input @error('website') border-red-500 @enderror"
                                value="{{ old('website') }}" placeholder="https://example.com">
                            @error('website')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-map-marker-alt mr-2 text-red-600"></i>
                        Address Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="form-label" for="address_line_1">Address Line 1</label>
                            <input type="text" id="address_line_1" name="address_line_1"
                                class="form-input @error('address_line_1') border-red-500 @enderror"
                                value="{{ old('address_line_1') }}">
                            @error('address_line_1')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label" for="address_line_2">Address Line 2</label>
                            <input type="text" id="address_line_2" name="address_line_2"
                                class="form-input @error('address_line_2') border-red-500 @enderror"
                                value="{{ old('address_line_2') }}">
                            @error('address_line_2')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="city">City</label>
                            <input type="text" id="city" name="city"
                                class="form-input @error('city') border-red-500 @enderror"
                                value="{{ old('city') }}">
                            @error('city')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="state">State/Province</label>
                            <input type="text" id="state" name="state"
                                class="form-input @error('state') border-red-500 @enderror"
                                value="{{ old('state') }}">
                            @error('state')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="postal_code">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code"
                                class="form-input @error('postal_code') border-red-500 @enderror"
                                value="{{ old('postal_code') }}">
                            @error('postal_code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="country">Country</label>
                            <input type="text" id="country" name="country"
                                class="form-input @error('country') border-red-500 @enderror"
                                value="{{ old('country', 'Sri Lanka') }}">
                            @error('country')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Information -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-building mr-2 text-yellow-600"></i>
                        Business Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label" for="tax_number">Tax Number</label>
                            <input type="text" id="tax_number" name="tax_number"
                                class="form-input @error('tax_number') border-red-500 @enderror"
                                value="{{ old('tax_number') }}">
                            @error('tax_number')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="registration_number">Registration Number</label>
                            <input type="text" id="registration_number" name="registration_number"
                                class="form-input @error('registration_number') border-red-500 @enderror"
                                value="{{ old('registration_number') }}">
                            @error('registration_number')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="credit_limit">Credit Limit (Rs.)</label>
                            <input type="number" id="credit_limit" name="credit_limit" step="0.01"
                                class="form-input @error('credit_limit') border-red-500 @enderror"
                                value="{{ old('credit_limit') }}" min="0">
                            @error('credit_limit')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="credit_period">Credit Period (Days)</label>
                            <input type="number" id="credit_period" name="credit_period"
                                class="form-input @error('credit_period') border-red-500 @enderror"
                                value="{{ old('credit_period') }}" min="0">
                            @error('credit_period')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="discount_percentage">Discount Percentage (%)</label>
                            <input type="number" id="discount_percentage" name="discount_percentage" step="0.01"
                                class="form-input @error('discount_percentage') border-red-500 @enderror"
                                value="{{ old('discount_percentage') }}" min="0" max="100">
                            @error('discount_percentage')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label" for="payment_terms">Payment Terms</label>
                            <textarea id="payment_terms" name="payment_terms" rows="3"
                                class="form-input @error('payment_terms') border-red-500 @enderror"
                                placeholder="Describe payment terms and conditions">{{ old('payment_terms') }}</textarea>
                            @error('payment_terms')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banking Information -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-university mr-2 text-purple-600"></i>
                        Banking Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="form-label" for="bank_name">Bank Name</label>
                            <input type="text" id="bank_name" name="bank_name"
                                class="form-input @error('bank_name') border-red-500 @enderror"
                                value="{{ old('bank_name') }}">
                            @error('bank_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="bank_account_number">Account Number</label>
                            <input type="text" id="bank_account_number" name="bank_account_number"
                                class="form-input @error('bank_account_number') border-red-500 @enderror"
                                value="{{ old('bank_account_number') }}">
                            @error('bank_account_number')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="bank_routing_number">Routing Number</label>
                            <input type="text" id="bank_routing_number" name="bank_routing_number"
                                class="form-input @error('bank_routing_number') border-red-500 @enderror"
                                value="{{ old('bank_routing_number') }}">
                            @error('bank_routing_number')
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

                    <div class="grid grid-cols-1 gap-6 mb-6">
                        <div>
                            <label class="form-label" for="notes">Notes</label>
                            <textarea id="notes" name="notes" rows="4"
                                class="form-input @error('notes') border-red-500 @enderror"
                                placeholder="Additional notes about this supplier">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                {{ old('is_active', true) ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Active
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="is_verified" name="is_verified" value="1"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                {{ old('is_verified') ? 'checked' : '' }}>
                            <label for="is_verified" class="ml-2 block text-sm text-gray-900">
                                Verified Supplier
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="is_preferred" name="is_preferred" value="1"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                {{ old('is_preferred') ? 'checked' : '' }}>
                            <label for="is_preferred" class="ml-2 block text-sm text-gray-900">
                                Preferred Supplier
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('suppliers.index') }}" class="btn-secondary">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    Save Supplier
                </button>
            </div>
        </form>
    </div>
@endsection
