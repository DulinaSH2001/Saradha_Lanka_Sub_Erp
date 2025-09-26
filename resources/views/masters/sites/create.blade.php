@extends('layouts.app')

@section('title', 'Add New Site - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-plus mr-2 text-green-600"></i>
                    Add New Site
                </h1>
                <p class="text-gray-600 mt-1">Create a new site location for your operations</p>
            </div>
            <a href="{{ route('sites.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Sites
            </a>
        </div>

        <form method="POST" action="{{ route('sites.store') }}" class="space-y-6">
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
                            <label class="form-label" for="name">Site Name *</label>
                            <input type="text" id="name" name="name"
                                class="form-input @error('name') border-red-500 @enderror"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="code">Site Code *</label>
                            <input type="text" id="code" name="code"
                                class="form-input @error('code') border-red-500 @enderror"
                                value="{{ old('code') }}" placeholder="e.g., SITE-001" required>
                            @error('code')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="type">Site Type *</label>
                            <select id="type" name="type"
                                class="form-input @error('type') border-red-500 @enderror" required>
                                <option value="">Select Type</option>
                                @foreach(App\Models\Site::getTypes() as $key => $label)
                                    <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" name="description" rows="3"
                                class="form-input @error('description') border-red-500 @enderror"
                                placeholder="Brief description of the site">{{ old('description') }}</textarea>
                            @error('description')
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
                        <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>
                        Address Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="form-label" for="address">Street Address *</label>
                            <textarea id="address" name="address" rows="2"
                                class="form-input @error('address') border-red-500 @enderror"
                                placeholder="Enter complete street address" required>{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="city">City *</label>
                            <input type="text" id="city" name="city"
                                class="form-input @error('city') border-red-500 @enderror"
                                value="{{ old('city') }}" required>
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
                            <label class="form-label" for="country">Country *</label>
                            <input type="text" id="country" name="country"
                                class="form-input @error('country') border-red-500 @enderror"
                                value="{{ old('country', 'Sri Lanka') }}" required>
                            @error('country')
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
                        <i class="fas fa-phone mr-2 text-purple-600"></i>
                        Contact Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label" for="phone">Site Phone</label>
                            <input type="tel" id="phone" name="phone"
                                class="form-input @error('phone') border-red-500 @enderror"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="email">Site Email</label>
                            <input type="email" id="email" name="email"
                                class="form-input @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="manager_name">Site Manager</label>
                            <input type="text" id="manager_name" name="manager_name"
                                class="form-input @error('manager_name') border-red-500 @enderror"
                                value="{{ old('manager_name') }}">
                            @error('manager_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="manager_phone">Manager Phone</label>
                            <input type="tel" id="manager_phone" name="manager_phone"
                                class="form-input @error('manager_phone') border-red-500 @enderror"
                                value="{{ old('manager_phone') }}">
                            @error('manager_phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="manager_email">Manager Email</label>
                            <input type="email" id="manager_email" name="manager_email"
                                class="form-input @error('manager_email') border-red-500 @enderror"
                                value="{{ old('manager_email') }}">
                            @error('manager_email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Details -->
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-cog mr-2 text-orange-600"></i>
                        Additional Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label" for="storage_capacity">Storage Capacity (sq ft)</label>
                            <input type="number" id="storage_capacity" name="storage_capacity"
                                class="form-input @error('storage_capacity') border-red-500 @enderror"
                                value="{{ old('storage_capacity') }}" min="0">
                            @error('storage_capacity')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="operating_hours">Operating Hours</label>
                            <input type="text" id="operating_hours" name="operating_hours"
                                class="form-input @error('operating_hours') border-red-500 @enderror"
                                value="{{ old('operating_hours') }}" placeholder="e.g., 9:00 AM - 6:00 PM">
                            @error('operating_hours')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="latitude">Latitude</label>
                            <input type="number" step="any" id="latitude" name="latitude"
                                class="form-input @error('latitude') border-red-500 @enderror"
                                value="{{ old('latitude') }}" placeholder="e.g., 6.9271">
                            @error('latitude')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="longitude">Longitude</label>
                            <input type="number" step="any" id="longitude" name="longitude"
                                class="form-input @error('longitude') border-red-500 @enderror"
                                value="{{ old('longitude') }}" placeholder="e.g., 79.8612">
                            @error('longitude')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" class="form-checkbox" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700">Site is active</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('sites.index') }}" class="btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    Create Site
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto-generate site code from name
        document.getElementById('name').addEventListener('input', function () {
            const name = this.value;
            const codeInput = document.getElementById('code');

            if (name && !codeInput.value) {
                // Generate a simple code from the name
                const code = 'SITE-' + name.toUpperCase().replace(/[^A-Z0-9]/g, '').substring(0, 6);
                codeInput.value = code;
            }
        });
    </script>
@endpush
