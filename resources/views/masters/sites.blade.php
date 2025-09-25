@extends('layouts.app')

@section('title', 'Sites - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>
                    Sites
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Manage your site locations and warehouses</p>
            </div>
            <button class="btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Add New Site
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/20 rounded-full">
                        <i class="fas fa-map-marker-alt text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Sites</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">15</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 dark:bg-green-900/20 rounded-full">
                        <i class="fas fa-warehouse text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Warehouses</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">8</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900/20 rounded-full">
                        <i class="fas fa-store text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Retail Outlets</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">5</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 dark:bg-orange-900/20 rounded-full">
                        <i class="fas fa-building text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Offices</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">2</p>
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
                            <input type="text" placeholder="Search sites..." class="form-input pl-10 w-full sm:w-80">
                        </div>
                        <select class="form-input">
                            <option>All Types</option>
                            <option>Warehouse</option>
                            <option>Retail Outlet</option>
                            <option>Office</option>
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button class="btn-secondary">
                            <i class="fas fa-map mr-2"></i>
                            Map View
                        </button>
                        <button class="btn-secondary">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sites Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Site
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Type
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Location
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Manager
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
                        <!-- Sample Site Row -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-warehouse text-white text-sm"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            Main Warehouse
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            SITE-001
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400">
                                    Warehouse
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                Colombo Industrial Zone
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                Sarah Johnson
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                    Active
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
                                        <i class="fas fa-map-marker-alt"></i>
                                    </button>
                                    <button
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Another sample row -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-store text-white text-sm"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            Kandy Retail Store
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            SITE-002
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-400">
                                    Retail Outlet
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                Kandy City Center
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                Michael Chen
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                    Active
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
                                        <i class="fas fa-map-marker-alt"></i>
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
                        Showing 1 to 10 of 15 results
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
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection