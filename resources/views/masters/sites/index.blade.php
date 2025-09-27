@extends('layouts.app')

@section('title', 'Sites - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>
                    Sites
                </h1>
                <p class="text-gray-600 mt-1">Manage your site locations and warehouses</p>
            </div>
            <a href="{{ route('sites.create') }}" class="btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Add New Site
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Sites</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-warehouse text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Warehouses</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['warehouses'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-full">
                        <i class="fas fa-store text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Retail Outlets</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['retail_outlets'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 rounded-full">
                        <i class="fas fa-building text-orange-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Offices</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['offices'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow mb-6 border border-gray-200">
            <div class="p-4">
                <form method="GET" action="{{ route('sites.index') }}">
                    <div class="flex flex-col sm:flex-row sm:items-end gap-3">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <div class="relative">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search by name, code, city..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Type Filter -->
                        <div class="sm:w-40">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <select name="type"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All Types</option>
                                @foreach(App\Models\Site::getTypes() as $key => $label)
                                    <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                                <i class="fas fa-search mr-1"></i>
                                Search
                            </button>
                            @if(request()->hasAny(['search', 'type']))
                                <a href="{{ route('sites.index') }}"
                                    class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                                    <i class="fas fa-times mr-1"></i>
                                    Clear
                                </a>
                            @endif
                            <button type="button"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center">
                                <i class="fas fa-download mr-1"></i>
                                Export
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sites Table -->
        <div class="bg-white rounded-lg shadow border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Site
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Location
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Manager
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
                        @forelse($sites as $site)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-10 h-10 bg-gradient-to-br {{
                            $site->type == 'warehouse' ? 'from-blue-500 to-blue-600 ' :
                            ($site->type == 'retail_outlet' ? 'from-purple-500 to-purple-600 ' :
                                ($site->type == 'office' ? 'from-orange-500 to-orange-600 ' :
                                    'from-green-500 to-green-600 '))
                                                                                                                                                                                                                                                                                                            }} rounded-full flex items-center justify-center">
                                                        <i
                                                            class="fas {{
                            $site->type == 'warehouse' ? 'fa-warehouse' :
                            ($site->type == 'retail_outlet' ? 'fa-store' :
                                ($site->type == 'office' ? 'fa-building' :
                                    'fa-industry'))
                                                                                                                                                                                                                                                                                                                }} text-white text-sm"></i>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $site->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $site->code }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                                                                                                                                                                                                        {{
                            $site->type == 'warehouse' ? 'bg-blue-100 text-blue-800' :
                            ($site->type == 'retail_outlet' ? 'bg-purple-100 text-purple-800' :
                                ($site->type == 'office' ? 'bg-orange-100 text-orange-800' :
                                    'bg-green-100 text-green-800'))
                                                                                                                                                                                                                                        }}">
                                                    {{ $site->type_display }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $site->city }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $site->manager_name ?? 'Not Assigned' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($site->is_active)
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <i class="fas fa-times-circle mr-1"></i>
                                                        Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-1">
                                                    <a href="{{ route('sites.show', $site) }}"
                                                        class="inline-flex items-center px-2 py-1 bg-green-100 hover:bg-green-200  text-green-700 text-xs font-medium rounded transition-colors duration-200"
                                                        title="View Site Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('sites.edit', $site) }}"
                                                        class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200text-xs font-medium rounded transition-colors duration-200"
                                                        title="Edit Site">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if($site->latitude && $site->longitude)
                                                        <button onclick="showOnMap({{ $site->latitude }}, {{ $site->longitude }})"
                                                            class="inline-flex items-center px-2 py-1 bg-purple-100 hover:bg-purple-200 text-purple-700  text-xs font-medium rounded transition-colors duration-200"
                                                            title="View on Map">
                                                            <i class="fas fa-map-marker-alt"></i>
                                                        </button>
                                                    @endif
                                                    <form method="POST" action="{{ route('sites.destroy', $site) }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this site? This action cannot be undone.')"
                                                            class="inline-flex items-center px-2 py-1 bg-red-100 hover:bg-red-200 text-red-700  text-xs font-medium rounded transition-colors duration-200"
                                                            title="Delete Site">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-500">
                                        <i class="fas fa-map-marker-alt text-4xl mb-4"></i>
                                        <h3 class="text-lg font-medium mb-2">No sites found</h3>
                                        <p class="text-sm mb-4">Get started by creating your first site.</p>
                                        <a href="{{ route('sites.create') }}" class="btn-primary">
                                            <i class="fas fa-plus mr-2"></i>
                                            Add New Site
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($sites->hasPages())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        @if($sites->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                                Previous
                            </span>
                        @else
                            <a href="{{ $sites->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                Previous
                            </a>
                        @endif

                        @if($sites->hasMorePages())
                            <a href="{{ $sites->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                Next
                            </a>
                        @else
                            <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                                Next
                            </span>
                        @endif
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium text-gray-900">{{ $sites->firstItem() }}</span>
                                to
                                <span class="font-medium text-gray-900">{{ $sites->lastItem() }}</span>
                                of
                                <span class="font-medium text-gray-900">{{ $sites->total() }}</span>
                                results
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                {{-- Previous Page Link --}}
                                @if ($sites->onFirstPage())
                                    <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-not-allowed">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                @else
                                    <a href="{{ $sites->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($sites->getUrlRange(1, $sites->lastPage()) as $page => $url)
                                    @if ($page == $sites->currentPage())
                                        <span class="relative inline-flex items-center px-4 py-2 border border-blue-500 bg-blue-50 text-sm font-medium text-blue-600">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($sites->hasMorePages())
                                    <a href="{{ $sites->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-not-allowed">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                @endif
                            </nav>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
