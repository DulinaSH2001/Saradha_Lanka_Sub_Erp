@extends('layouts.app')

@section('title', 'Items - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    <i class="fas fa-boxes mr-2 text-green-600"></i>
                    Items
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Manage your product catalog and inventory items</p>
            </div>
            <button class="btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Add New Item
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/20 rounded-full">
                        <i class="fas fa-boxes text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Items</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">2,847</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 dark:bg-green-900/20 rounded-full">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Items</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">2,456</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 dark:bg-yellow-900/20 rounded-full">
                        <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Low Stock</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">123</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 dark:bg-red-900/20 rounded-full">
                        <i class="fas fa-times-circle text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Out of Stock</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">47</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6 border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Search items..." class="form-input pl-10 w-full sm:w-80">
                        </div>
                        <select class="form-input">
                            <option>All Categories</option>
                            <option>Electronics</option>
                            <option>Clothing</option>
                            <option>Home & Garden</option>
                            <option>Sports</option>
                        </select>
                        <select class="form-input">
                            <option>All Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                            <option>Low Stock</option>
                            <option>Out of Stock</option>
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button class="btn-secondary">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
                        <button class="btn-secondary">
                            <i class="fas fa-barcode mr-2"></i>
                            Barcode
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Item
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Category
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Price
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Stock
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Sample Item Row -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-laptop text-white"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            Dell XPS 15 Laptop
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            SKU: DELL-XPS-15-001
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400">
                                    Electronics
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                <div>₹ 1,25,000</div>
                                <div class="text-xs text-gray-500">Cost: ₹ 95,000</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                <div>25 units</div>
                                <div class="text-xs text-gray-500">Min: 10</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                    In Stock
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button
                                        class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button
                                        class="text-purple-600 hover:text-purple-900 dark:text-purple-400 dark:hover:text-purple-300">
                                        <i class="fas fa-barcode"></i>
                                    </button>
                                    <button
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Another sample row with low stock warning -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-tshirt text-white"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            Cotton T-Shirt (Blue)
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            SKU: TSHRT-BLU-M-001
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-400">
                                    Clothing
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                <div>₹ 890</div>
                                <div class="text-xs text-gray-500">Cost: ₹ 450</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                <div class="text-yellow-600 font-medium">8 units</div>
                                <div class="text-xs text-gray-500">Min: 15</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400">
                                    Low Stock
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button
                                        class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button
                                        class="text-purple-600 hover:text-purple-900 dark:text-purple-400 dark:hover:text-purple-300">
                                        <i class="fas fa-barcode"></i>
                                    </button>
                                    <button
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white dark:bg-gray-800 px-6 py-3 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        Showing 1 to 10 of 2,847 results
                    </div>
                    <div class="flex space-x-1">
                        <button
                            class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700 dark:text-gray-300">
                            Previous
                        </button>
                        <button class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700">
                            1
                        </button>
                        <button
                            class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700 dark:text-gray-300">
                            2
                        </button>
                        <button
                            class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700 dark:text-gray-300">
                            3
                        </button>
                        <button
                            class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700 dark:text-gray-300">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection