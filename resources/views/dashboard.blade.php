@extends('layouts.app')

@section('title', 'Dashboard - Saradha Lanka ERP')

@section('content')
    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Welcome back!</h2>
                    <p class="text-gray-600 mt-1">Here's what's happening in your business today.</p>
                </div>
                <div class="hidden sm:block">
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Sales -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Sales</p>
                        <p class="text-2xl font-bold text-gray-900">Rs. 1,250,000</p>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-600 text-sm font-medium">+12%</span>
                    <span class="text-gray-500 text-sm">from last month</span>
                </div>
            </div>

            <!-- Orders -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M8 11v6h8v-6M8 11H6a2 2 0 00-2 2v6a2 2 0 002 2h12a2 2 0 002-2v-6a2 2 0 00-2-2h-2">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Orders</p>
                        <p class="text-2xl font-bold text-gray-900">856</p>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-600 text-sm font-medium">+8%</span>
                    <span class="text-gray-500 text-sm">from last month</span>
                </div>
            </div>

            <!-- Customers -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Customers</p>
                        <p class="text-2xl font-bold text-gray-900">2,345</p>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-600 text-sm font-medium">+15%</span>
                    <span class="text-gray-500 text-sm">from last month</span>
                </div>
            </div>

            <!-- Inventory -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Stock Items</p>
                        <p class="text-2xl font-bold text-gray-900">12,847</p>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-red-600 text-sm font-medium">-3%</span>
                    <span class="text-gray-500 text-sm">from last month</span>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sales Chart -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Sales Overview</h3>
                    <select class="text-sm border border-gray-300 rounded-md px-3 py-1">
                        <option>Last 7 days</option>
                        <option>Last 30 days</option>
                        <option>Last 3 months</option>
                    </select>
                </div>
                <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                        <p class="text-gray-500">Chart will be displayed here</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">New order #ORD-001</p>
                            <p class="text-xs text-gray-500">2 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">Payment received</p>
                            <p class="text-xs text-gray-500">15 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">Low stock alert</p>
                            <p class="text-xs text-gray-500">1 hour ago</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-900">New customer registered</p>
                            <p class="text-xs text-gray-500">3 hours ago</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium">View all activity →</a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <button
                    class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors duration-200">
                    <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-medium text-gray-900">New Order</p>
                        <p class="text-xs text-gray-500">Create new sales order</p>
                    </div>
                </button>

                <button
                    class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-medium text-gray-900">Add Customer</p>
                        <p class="text-xs text-gray-500">Register new customer</p>
                    </div>
                </button>

                <button
                    class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors duration-200">
                    <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-medium text-gray-900">Stock Update</p>
                        <p class="text-xs text-gray-500">Update inventory levels</p>
                    </div>
                </button>

                <button
                    class="flex items-center p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors duration-200">
                    <div class="w-8 h-8 bg-orange-500 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-medium text-gray-900">Generate Report</p>
                        <p class="text-xs text-gray-500">View business reports</p>
                    </div>
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            // Keep the existing authentication logic for now
            (function () {
                const token = localStorage.getItem('auth_token');
                if (!token) {
                    window.location.href = '/login';
                    return;
                }

                // You can display user info in a more elegant way now
                $.ajax({
                    url: '/api/me',
                    headers: { 'Authorization': 'Bearer ' + token },
                    success: function (res) {
                        // Update user display in header or show welcome message
                        console.log('User data:', res);
                    },
                    error: function () {
                        console.log('Failed to load user data');
                    }
                });
            })();
        </script>
    @endpush
@endsection