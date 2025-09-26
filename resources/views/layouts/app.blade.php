<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/icons-sprite.svg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')

    <!-- User Preferences Script (Load before body) -->
    <script>
        // Load user settings if authenticated
        @if(Auth::check())
            const userSettings = @json(Auth::user()->settings ?? null);

            // Apply theme setting - prioritize user settings
            @auth
                const userTheme = '{{ Auth::user()->settings->theme ?? "light" }}';
            @else
                const userTheme = localStorage.getItem('theme') || 'light';
            @endauth
            document.documentElement.setAttribute('data-theme', userTheme);
            localStorage.setItem('theme', userTheme);

            // Apply sidebar setting
            const sidebarCollapsed = userSettings?.sidebar_collapsed || localStorage.getItem('sidebar-collapsed') === 'true';
            localStorage.setItem('sidebar-collapsed', sidebarCollapsed ? 'true' : 'false');

            // Apply other settings
            if (userSettings) {
                // Set language
                if (userSettings.language && userSettings.language !== 'en') {
                    document.documentElement.setAttribute('lang', userSettings.language);
                }

                // Set timezone (for later use in JS)
                window.userTimezone = userSettings.timezone || 'UTC';
                window.dateFormat = userSettings.date_format || 'Y-m-d';
                window.itemsPerPage = userSettings.items_per_page || 25;
            }
        @else
                        // Check for saved theme preference or default to 'light'
                        const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
        @endif

        // Update toggle state on page load
        document.addEventListener('DOMContentLoaded', function () {
            const toggleInput = document.getElementById('darkModeToggle');
            if (toggleInput) {
                @auth
                    toggleInput.checked = '{{ Auth::user()->settings->theme ?? "light" }}' === 'dark';
                @else
                    toggleInput.checked = localStorage.getItem('theme') === 'dark';
                @endauth
            }
        });
    </script>
</head>

<body class="min-h-screen bg-gray-50 font-inter transition-colors duration-300" data-theme-target="body">
    <div class="flex h-screen bg-gray-50 transition-colors duration-300" data-theme-target="container">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-all duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 lg:w-64">
            @include('layouts.sidebar')
        </aside>

        <!-- Sidebar Overlay (Mobile) -->
        <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                @include('layouts.header')
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-6 py-8">
                    <!-- Page Header -->
                    @if (isset($pageTitle) || isset($breadcrumbs))
                        <div class="mb-8">
                            @isset($pageTitle)
                                <h1 class="text-3xl font-bold text-gray-900">{{ $pageTitle }}</h1>
                            @endisset

                            @isset($breadcrumbs)
                                <nav class="mt-2">
                                    <ol class="flex items-center space-x-2 text-sm">
                                        @foreach ($breadcrumbs as $breadcrumb)
                                            <li class="flex items-center">
                                                @if (!$loop->first)
                                                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                @endif
                                                @if (isset($breadcrumb['url']) && !$loop->last)
                                                    <a href="{{ $breadcrumb['url'] }}"
                                                        class="text-green-600 hover:text-green-800">{{ $breadcrumb['name'] }}</a>
                                                @else
                                                    <span class="text-gray-500">{{ $breadcrumb['name'] }}</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ol>
                                </nav>
                            @endisset
                        </div>
                    @endif

                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg" id="flash-message">
                            <div class="flex items-center">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                                <div class="ml-auto">
                                    <button onclick="document.getElementById('flash-message').remove()"
                                        class="text-green-400 hover:text-green-600 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg" id="flash-error">
                            <div class="flex items-center">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                </div>
                                <div class="ml-auto">
                                    <button onclick="document.getElementById('flash-error').remove()"
                                        class="text-red-400 hover:text-red-600 transition-colors duration-200">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Content -->
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200">
                @include('layouts.footer')
            </footer>
        </div>
    </div>

    <!-- Layout Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sidebar is always visible, no toggle functionality

            // Dark Mode Toggle Functionality
            const darkModeToggle = document.getElementById('darkModeToggle');

            function toggleTheme() {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);

                // Update toggle state
                if (darkModeToggle) {
                    darkModeToggle.checked = newTheme === 'dark';
                }

                // Save theme preference to user settings
                @auth
                    fetch('{{ route("profile.theme.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            theme: newTheme
                        })
                    }).catch(error => {
                        console.log('Failed to save theme preference:', error);
                    });
                @endauth

                // Add smooth transition effect
                document.body.classList.add('theme-transitioning');
                setTimeout(() => {
                    document.body.classList.remove('theme-transitioning');
                }, 300);
            }

            if (darkModeToggle) {
                darkModeToggle.addEventListener('change', toggleTheme);
            }
        });
    </script>

    <!-- Flash Message Auto Dismiss -->
    <script>
        // Auto dismiss flash messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function () {
            const flashMessage = document.getElementById('flash-message');
            const flashError = document.getElementById('flash-error');

            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.style.opacity = '0';
                    setTimeout(() => flashMessage.remove(), 300);
                }, 5000);
            }

            if (flashError) {
                setTimeout(() => {
                    flashError.style.opacity = '0';
                    setTimeout(() => flashError.remove(), 300);
                }, 7000);
            }
        });
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
});
</script>

<!-- Additional Scripts -->
@stack('scripts')
</body>

</html>