@extends('layouts.app')

@section('title', 'Account Details - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-calculator mr-2 text-green-600"></i>
                    {{ $account->name }}
                </h1>
                <p class="text-gray-600 mt-1">Account details and information</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('accounts.edit', $account) }}" class="btn-primary">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Account
                </a>
                <a href="{{ route('accounts.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Accounts
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Account Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                            Account Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Account Name</label>
                                <p class="text-lg font-medium text-gray-900">{{ $account->name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Account Code</label>
                                <p class="text-lg text-gray-900">
                                    @if($account->code)
                                        <span
                                            class="font-mono bg-gray-100 px-2 py-1 rounded text-sm">{{ $account->code }}</span>
                                    @else
                                        <span class="text-gray-500 italic">Not specified</span>
                                    @endif
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Account Type</label>
                                <p class="text-lg text-gray-900">
                                    @if($account->type)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ ucfirst($account->type) }}
                                        </span>
                                    @else
                                        <span class="text-gray-500 italic">Not specified</span>
                                    @endif
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Current Balance</label>
                                <p class="text-2xl font-bold text-gray-900">
                                    LKR {{ number_format($account->balance ?? 0, 2) }}
                                </p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <p class="text-gray-900">
                                    @if($account->description)
                                        {{ $account->description }}
                                    @else
                                        <span class="text-gray-500 italic">No description provided</span>
                                    @endif
                                </p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <p class="text-lg">
                                    @if($account->is_active)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Inactive
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Panel -->
            <div class="lg:col-span-1">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-bolt mr-2 text-yellow-500"></i>
                            Quick Actions
                        </h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('accounts.edit', $account) }}" class="w-full btn-secondary">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Account
                        </a>

                        <form action="{{ route('accounts.toggle-status', $account) }}" method="POST" class="w-full">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full btn-secondary">
                                <i class="fas fa-power-off mr-2"></i>
                                {{ $account->is_active ? 'Deactivate' : 'Activate' }} Account
                            </button>
                        </form>

                        <div class="border-t pt-3">
                            <form action="{{ route('accounts.destroy', $account) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this account? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-trash mr-2"></i>
                                    Delete Account
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Account History -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-history mr-2 text-gray-500"></i>
                            Account History
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-medium text-gray-700">Created:</span>
                            <span class="text-gray-600">{{ $account->created_at->format('M j, Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-medium text-gray-700">Last Updated:</span>
                            <span class="text-gray-600">{{ $account->updated_at->format('M j, Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="font-medium text-gray-700">Age:</span>
                            <span class="text-gray-600">{{ $account->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction History (Placeholder for future implementation) -->
        <div class="mt-6">
            <div class="bg-white rounded-lg shadow border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-list mr-2 text-purple-500"></i>
                        Recent Transactions
                    </h3>
                </div>
                <div class="p-6">
                    <div class="text-center py-8">
                        <i class="fas fa-receipt text-gray-300 text-4xl mb-4"></i>
                        <h4 class="text-lg font-medium text-gray-600 mb-2">No transactions yet</h4>
                        <p class="text-gray-500">Transaction history will appear here once you start using this account.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection