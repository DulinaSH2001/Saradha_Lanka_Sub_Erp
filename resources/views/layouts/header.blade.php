<div class="flex items-center justify-between px-6 py-4">
    <!-- Left: Logo -->
    <div class="flex items-center">
        <!-- Logo & Title -->
        <div class="flex items-center">
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
                <input type="checkbox" id="darkModeToggle" @auth {{ Auth::user()->settings && Auth::user()->settings->theme === 'dark' ? 'checked' : '' }} @endauth>
                <span class="theme-slider"></span>
            </label>
        </div>

        <!-- User Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center space-x-3 p-2 rounded-lg hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors duration-200">
                @if(Auth::check())
                    @php
                        $user = Auth::user();
                        $avatar_url = $user->avatar ? asset('storage/' . $user->avatar) : null;
                        $full_name = trim($user->first_name . ' ' . $user->last_name) ?: $user->name;
                        $initials = strtoupper(substr($full_name, 0, 1) . (strpos($full_name, ' ') !== false ? substr($full_name, strpos($full_name, ' ') + 1, 1) : ''));
                    @endphp
                    @if($avatar_url)
                        <img class="w-8 h-8 rounded-full object-cover border-2 border-green-200" src="{{ $avatar_url }}"
                            alt="{{ $full_name }}">
                    @else
                        <div
                            class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center border-2 border-green-200">
                            <span class="text-white text-sm font-semibold">{{ $initials }}</span>
                        </div>
                    @endif
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-medium text-gray-900">{{ $full_name }}</p>
                        <p class="text-xs text-gray-500">{{ $user->position ?? 'Employee' }}</p>
                    </div>
                @else
                    <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">G</span>
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-medium text-gray-900">Guest</p>
                        <p class="text-xs text-gray-500">Not logged in</p>
                    </div>
                @endif
                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{ 'rotate-180': open }"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    @if(Auth::check())
                        <div class="px-4 py-3 border-b border-gray-200">
                            <div class="flex items-center space-x-3">
                                @if(Auth::user()->avatar_url)
                                    <img class="w-10 h-10 rounded-full object-cover" src="{{ Auth::user()->avatar_url }}"
                                        alt="{{ Auth::user()->full_name }}">
                                @else
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ Auth::user()->initials }}</span>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->full_name }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                    @if(Auth::user()->employee_id)
                                        <p class="text-xs text-green-600 font-medium">ID: {{ Auth::user()->employee_id }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Menu Items -->
                    <div class="py-2">
                        <a href="{{ route('profile.show') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 {{ request()->routeIs('profile.show') ? 'bg-green-50 text-green-700' : '' }}"
                            @click="open = false">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            My Profile
                        </a>
                        <a href="{{ route('profile.settings') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 {{ request()->routeIs('profile.settings') ? 'bg-green-50 text-green-700' : '' }}"
                            @click="open = false">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Account Settings
                        </a>
                        <div class="border-t border-gray-200 my-2"></div>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 5a2 2 0 012-2h2a2 2 0 012 2v0H8v0z"></path>
                            </svg>
                            Dashboard
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
            headerLogoutBtn.addEventListener('click', function (e) {
                e.preventDefault();

                // Clear any local storage data that might interfere
                localStorage.removeItem('auth_token');
                localStorage.removeItem('auth_user');

                // Create a form to submit logout request properly
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("logout") }}';
                form.style.display = 'none';

                // Add CSRF token
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                form.appendChild(csrfToken);

                // Add form to body and submit
                document.body.appendChild(form);
                form.submit();
            });
        }
    });
</script>
