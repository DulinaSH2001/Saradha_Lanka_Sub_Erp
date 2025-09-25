@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Profile Header -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">My Profile</h1>
                        <p class="text-sm text-gray-600">Manage your personal information and account settings</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('profile.settings') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            <i class="fas fa-cog w-4 h-4 mr-2"></i>
                            Settings
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Profile Picture Section -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 rounded-lg p-6 text-center">
                            <div class="mb-4">
                                @if($user->avatar_url)
                                    <img class="w-32 h-32 rounded-full mx-auto object-cover shadow-lg"
                                        src="{{ $user->avatar_url }}" alt="{{ $user->full_name }}">
                                @else
                                    <div
                                        class="w-32 h-32 bg-gradient-to-br from-green-500 to-green-600 rounded-full mx-auto flex items-center justify-center shadow-lg">
                                        <span class="text-white font-bold text-3xl">{{ $user->initials }}</span>
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $user->full_name }}</h3>
                            <p class="text-sm text-gray-600">{{ $user->position ?? 'Employee' }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $user->department ?? 'No Department' }}</p>

                            @if($user->employee_id)
                                <div
                                    class="mt-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    ID: {{ $user->employee_id }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Profile Information -->
                    <div class="lg:col-span-2">
                        <!-- Success Message -->
                        @if(session('success'))
                            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle w-5 h-5 mr-2"></i>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        <!-- Profile Form -->
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf
                            @method('PUT')

                            <!-- Basic Information -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name
                                            *</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                            required>
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="employee_id"
                                            class="block text-sm font-medium text-gray-700 mb-2">Employee ID</label>
                                        <input type="text" name="employee_id" id="employee_id"
                                            value="{{ old('employee_id', $user->employee_id) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('employee_id')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First
                                            Name</label>
                                        <input type="text" name="first_name" id="first_name"
                                            value="{{ old('first_name', $user->first_name) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('first_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last
                                            Name</label>
                                        <input type="text" name="last_name" id="last_name"
                                            value="{{ old('last_name', $user->last_name) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('last_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                                            Address *</label>
                                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                            required>
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone
                                            Number</label>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Work Information -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Work Information</h4>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="position"
                                            class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                                        <input type="text" name="position" id="position"
                                            value="{{ old('position', $user->position) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('position')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="department"
                                            class="block text-sm font-medium text-gray-700 mb-2">Department</label>
                                        <input type="text" name="department" id="department"
                                            value="{{ old('department', $user->department) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('department')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-2">
                                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date
                                            of Birth</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth"
                                            value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @error('date_of_birth')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Picture -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">Profile Picture</h4>

                                <div>
                                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Upload New
                                        Picture</label>
                                    <input type="file" name="avatar" id="avatar"
                                        accept="image/jpeg,image/png,image/jpg,image/gif"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <p class="text-xs text-gray-500 mt-1">Supported formats: JPEG, PNG, JPG, GIF. Max size:
                                        2MB</p>
                                    @error('avatar')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    <i class="fas fa-save w-4 h-4 mr-2"></i>
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password Section -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Change Password</h2>
                <p class="text-sm text-gray-600">Update your password to keep your account secure</p>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('profile.password') }}" class="max-w-lg">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current
                                Password</label>
                            <input type="password" name="current_password" id="current_password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                required>
                            @error('current_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm
                                New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <i class="fas fa-key w-4 h-4 mr-2"></i>
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection