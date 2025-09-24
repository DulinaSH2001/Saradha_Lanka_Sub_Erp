<div class="flex items-center justify-between px-6 py-4">
    <!-- Left: Mobile Menu Toggle & Logo -->
    <div class="flex items-center">
        <!-- Mobile Menu Toggle -->
        <button id="menu-toggle"
            class="lg:hidden p-2 rounded-md text-gray-600 hover:text-green-600 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>

        <!-- Logo & Title -->
        <div class="flex items-center ml-4 lg:ml-0">
            <div class="flex items-center">
                <div
                    class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-lg">S</span>
                </div>
                <div class="ml-3 hidden sm:block">
                    <h1 class="text-xl font-bold text-gray-900">Saradha Lanka</h1>
                    <p class="text-sm text-gray-500">ERP System</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Center: Search Bar (Hidden on mobile) -->
    <div class="hidden md:flex flex-1 max-w-lg mx-8">
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" placeholder="Search..."
                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-green-500">
        </div>
    </div>

    <!-- Right: Notifications & User Menu -->
    <div class="flex items-center space-x-4">
        <!-- Notifications -->
        <div class="relative">
            <button
                class="p-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
                <!-- Notification Badge -->
                <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
            </button>
        </div>

        <!-- Dark Mode Toggle -->
        <div class="flex items-center">
            <label class="theme-toggle">
                <input type="checkbox" id="darkModeToggle">
                <span class="theme-slider"></span>
            </label>
        </div>

        <!-- User Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center space-x-3 p-2 rounded-lg hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500">
                <div
                    class="w-8 h-8 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-medium">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </span>
                </div>
                <div class="hidden md:block text-left">
                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name ?? 'User' }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                <div class="py-2">
                    <!-- Profile Section -->
                    <div class="px-4 py-3 border-b border-gray-200">
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name ?? 'User' }}</p>
                        <p class="text-sm text-gray-500">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                    </div>

                    <!-- Menu Items -->
                    <div class="py-2">
                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profile
                        </a>
                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </a>
                        <a href="#"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Help & Support
                        </a>
                    </div>

                    <!-- Logout -->
                    <div class="border-t border-gray-200 py-2">
                        <button type="button" id="headerLogoutBtn"
                            class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Sign out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Search (Hidden by default) -->
<div class="md:hidden px-6 pb-4">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input type="text" placeholder="Search..."
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-green-500">
    </div>
</div>

<!-- Alpine.js for dropdown functionality -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<!-- Logout functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const headerLogoutBtn = document.getElementById('headerLogoutBtn');

        if (headerLogoutBtn) {
            headerLogoutBtn.addEventListener('click', function () {
                const token = localStorage.getItem('auth_token');

                if (token) {
                    // Call the API logout endpoint
                    fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => {
                            // Always clear local storage and redirect, regardless of API response
                            localStorage.removeItem('auth_token');
                            localStorage.removeItem('auth_user');
                            window.location.href = '/login';
                        })
                        .catch(error => {
                            // Even if there's an error, clear local storage and redirect
                            console.log('Logout error:', error);
                            localStorage.removeItem('auth_token');
                            localStorage.removeItem('auth_user');
                            window.location.href = '/login';
                        });
                } else {
                    // No token found, just redirect
                    window.location.href = '/login';
                }
            });
        }
    });
</script>