@extends('layouts.app')

@section('title', 'Site Details - Saradha Lanka ERP')

@section('content')
    <div class="p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-{{
        $site->type == 'warehouse' ? 'warehouse' :
        ($site->type == 'retail_outlet' ? 'store' :
            ($site->type == 'office' ? 'building' : 'industry'))
                                        }} mr-2 text-green-600"></i>
                    {{ $site->name }}
                </h1>
                <p class="text-gray-600 mt-1">Site Code: {{ $site->code }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('sites.edit', $site) }}" class="btn-primary">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Site
                </a>
                <a href="{{ route('sites.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Sites
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Information -->
            <div class="lg:col-span-2">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                            Basic Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                                <p class="text-gray-900">{{ $site->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Site Code</label>
                                <p class="text-gray-900 font-mono">{{ $site->code }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{
        $site->type == 'warehouse' ? 'bg-blue-100 text-blue-800' :
        ($site->type == 'retail_outlet' ? 'bg-purple-100 text-purple-800' :
            ($site->type == 'office' ? 'bg-orange-100 text-orange-800' :
                'bg-green-100 text-green-800'))
                                                    }}">
                                    {{ $site->type_display }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{
        $site->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                                                    }}">
                                    {{ $site->status_text }}
                                </span>
                            </div>
                            @if($site->description)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <p class="text-gray-900">{{ $site->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>
                            Address Information
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Full Address</label>
                                <p class="text-gray-900">{{ $site->full_address }}</p>
                            </div>
                            @if($site->latitude && $site->longitude)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Coordinates</label>
                                    <p class="text-gray-900 font-mono">{{ $site->latitude }}, {{ $site->longitude }}</p>
                                    <button onclick="showOnMap({{ $site->latitude }}, {{ $site->longitude }})"
                                        class="mt-2 text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-external-link-alt mr-1"></i>
                                        View on Map
                                    </button>
                                </div>
                            @endif
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
                            @if($site->phone)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Site Phone</label>
                                    <p class="text-gray-900">
                                        <a href="tel:{{ $site->phone }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $site->phone }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                            @if($site->email)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Site Email</label>
                                    <p class="text-gray-900">
                                        <a href="mailto:{{ $site->email }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $site->email }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                            @if($site->manager_name)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Site Manager</label>
                                    <p class="text-gray-900">{{ $site->manager_name }}</p>
                                </div>
                            @endif
                            @if($site->manager_phone)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Manager Phone</label>
                                    <p class="text-gray-900">
                                        <a href="tel:{{ $site->manager_phone }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $site->manager_phone }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                            @if($site->manager_email)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Manager Email</label>
                                    <p class="text-gray-900">
                                        <a href="mailto:{{ $site->manager_email }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $site->manager_email }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-bolt mr-2 text-yellow-600"></i>
                            Quick Actions
                        </h3>
                        <div class="space-y-3">
                            <a href="{{ route('sites.edit', $site) }}" class="w-full btn-primary block text-center">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Site
                            </a>
                            <form method="POST" action="{{ route('sites.toggle-status', $site) }}" class="w-full">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full btn-secondary">
                                    <i class="fas fa-{{ $site->is_active ? 'pause' : 'play' }} mr-2"></i>
                                    {{ $site->is_active ? 'Deactivate' : 'Activate' }} Site
                                </button>
                            </form>
                            @if($site->latitude && $site->longitude)
                                <button onclick="showOnMap({{ $site->latitude }}, {{ $site->longitude }})"
                                    class="w-full btn-secondary">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    View on Map
                                </button>
                            @endif
                            <form method="POST" action="{{ route('sites.destroy', $site) }}"
                                onsubmit="return confirm('Are you sure you want to delete this site? This action cannot be undone.')"
                                class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                    <i class="fas fa-trash mr-2"></i>
                                    Delete Site
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Additional Details -->
                <div class="bg-white rounded-lg shadow border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-info mr-2 text-blue-600"></i>
                            Additional Details
                        </h3>
                        <div class="space-y-3">
                            @if($site->storage_capacity)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Storage Capacity</label>
                                    <p class="text-gray-900">{{ number_format($site->storage_capacity) }} sq ft</p>
                                </div>
                            @endif
                            @if($site->operating_hours)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Operating Hours</label>
                                    <p class="text-gray-900">{{ $site->operating_hours }}</p>
                                </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Created</label>
                                <p class="text-gray-900">{{ $site->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Updated</label>
                                <p class="text-gray-900">{{ $site->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showOnMap(lat, lng) {
            // Open Google Maps with the coordinates
            const url = `https://www.google.com/maps/@${lat},${lng},15z`;
            window.open(url, '_blank');
        }
    </script>
@endpush