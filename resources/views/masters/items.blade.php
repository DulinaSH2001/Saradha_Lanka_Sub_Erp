@extends('layouts.app')

@section('title', 'Items - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-boxes mr-2 text-green-600"></i>
                    Items
                </h1>
                <p class="text-gray-600 mt-1">Manage your product catalog and inventory items</p>
            </div>
            <button class="btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Add New Item
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white  rounded-lg shadow p-6 border border-gray-200 ">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-boxes text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Items</p>
                        <p class="text-2xl font-bold text-gray-900">2,847</p>
                    </div>
                </div>
            </div>

            <div class="bg-white  rounded-lg shadow p-6 border border-gray-200 ">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Items</p>
                        <p class="text-2xl font-bold text-gray-900">2,456</p>
                    </div>
                </div>
            </div>

            <div class="bg-white  rounded-lg shadow p-6 border border-gray-200 ">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Low Stock</p>
                        <p class="text-2xl font-bold text-gray-900">123</p>
                    </div>
                </div>
            </div>

            <div class="bg-white  rounded-lg shadow p-6 border border-gray-200 ">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-full">
                        <i class="fas fa-times-circle text-red-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Out of Stock</p>
                        <p class="text-2xl font-bold text-gray-900">47</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow mb-6 border border-gray-200">
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                        <div class="relative">
                            <i
                                class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400pointer-events-none z-10"></i>
                            <input type="text" placeholder="Search items..." class="form-search w-full sm:w-80">
                        </div>
                        <select
                            class="px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option>All Categories</option>
                            <option>Electronics</option>
                            <option>Clothing</option>
                            <option>Home & Garden</option>
                            <option>Sports</option>
                        </select>
                        <select
                            class="px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option>All Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                            <option>Low Stock</option>
                            <option>Out of Stock</option>
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button
                            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
                        <button
                            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                            <i class="fas fa-barcode mr-2"></i>
                            Barcode
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Item
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Sample Item Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-laptop text-white"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            Dell XPS 15 Laptop
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            SKU: DELL-XPS-15-001
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Electronics
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div>₹ 1,25,000</div>
                                <div class="text-xs text-gray-500">Cost: ₹ 95,000</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div>25 units</div>
                                <div class="text-xs text-gray-500">Min: 10</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    In Stock
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-purple-600 hover:text-purple-900">
                                        <i class="fas fa-barcode"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Another sample row with low stock warning -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-tshirt text-white"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            Cotton T-Shirt (Blue)
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            SKU: TSHRT-BLU-M-001
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                    Clothing
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div>₹ 890</div>
                                <div class="text-xs text-gray-500">Cost: ₹ 450</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="text-yellow-600 font-medium">8 units</div>
                                <div class="text-xs text-gray-500">Min: 15</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Low Stock
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="text-purple-600 hover:text-purple-900">
                                        <i class="fas fa-barcode"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-6 py-3 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing 1 to 10 of 2,847 results
                    </div>
                    <div class="flex space-x-1">
                        <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 text-gray-700">
                            Previous
                        </button>
                        <button class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700">
                            1
                        </button>
                        <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 text-gray-700">
                            2
                        </button>
                        <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 text-gray-700">
                            3
                        </button>
                        <button class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50 text-gray-700">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection