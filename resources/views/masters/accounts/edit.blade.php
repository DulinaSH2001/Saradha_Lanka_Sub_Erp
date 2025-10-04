@extends('layouts.app')

@section('title', 'Edit Account - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-edit mr-2 text-blue-600"></i>
                    Edit Account: {{ $account->name }}
                </h1>
                <p class="text-gray-600 mt-1">Update account information and settings</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('accounts.show', $account) }}" class="btn-secondary">
                    <i class="fas fa-eye mr-2"></i>
                    View Account
                </a>
                <a href="{{ route('accounts.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Accounts
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <form action="{{ route('accounts.update', $account) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Basic Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Account Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Account Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $account->name) }}"
                                class="form-input @error('name') border-red-300 @enderror"
                                placeholder="Enter account name" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Account Code -->
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                Account Code
                            </label>
                            <input type="text" name="code" id="code" value="{{ old('code', $account->code) }}"
                                class="form-input @error('code') border-red-300 @enderror"
                                placeholder="Enter account code (optional)">
                            @error('code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Account Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                Account Type
                            </label>
                            <select name="type" id="type" class="form-input @error('type') border-red-300 @enderror">
                                <option value="">Select Account Type</option>
                                <option value="asset" {{ old('type', $account->type) === 'asset' ? 'selected' : '' }}>Asset</option>
                                <option value="liability" {{ old('type', $account->type) === 'liability' ? 'selected' : '' }}>Liability</option>
                                <option value="equity" {{ old('type', $account->type) === 'equity' ? 'selected' : '' }}>Equity</option>
                                <option value="revenue" {{ old('type', $account->type) === 'revenue' ? 'selected' : '' }}>Revenue</option>
                                <option value="expense" {{ old('type', $account->type) === 'expense' ? 'selected' : '' }}>Expense</option>
                                <option value="other" {{ old('type', $account->type) === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Balance -->
                        <div>
                            <label for="balance" class="block text-sm font-medium text-gray-700 mb-2">
                                Current Balance
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">LKR</span>
                                <input type="number" name="balance" id="balance" value="{{ old('balance', $account->balance) }}"
                                    step="0.01" class="form-input pl-12 @error('balance') border-red-300 @enderror"
                                    placeholder="0.00">
                            </div>
                            @error('balance')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="3"
                            class="form-input @error('description') border-red-300 @enderror"
                            placeholder="Enter account description (optional)">{{ old('description', $account->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-toggle-on mr-2 text-green-500"></i>
                        Account Status
                    </h3>

                    <div class="flex items-center">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', $account->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Account is active
                        </label>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Active accounts can be used in transactions</p>
                </div>

                <!-- Account History -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                        <i class="fas fa-history mr-2 text-gray-500"></i>
                        Account Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div>
                            <span class="font-medium text-gray-700">Created:</span>
                            <span class="text-gray-600">{{ $account->created_at->format('M j, Y \a\t g:i A') }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Last Updated:</span>
                            <span class="text-gray-600">{{ $account->updated_at->format('M j, Y \a\t g:i A') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex items-center space-x-3">
                        <button type="submit" class="btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            Update Account
                        </button>
                        <a href="{{ route('accounts.show', $account) }}" class="btn-secondary">
                            <i class="fas fa-eye mr-2"></i>
                            View Account
                        </a>
                        <a href="{{ route('accounts.index') }}" class="btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                    </div>
                    <p class="text-sm text-gray-500">
                        <span class="text-red-500">*</span> Required fields
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
