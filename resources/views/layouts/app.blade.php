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

    <!-- Dark Mode Script (Load before body) -->
    <script>
        // Check for saved theme preference or default to 'light'
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);

        // Update toggle state on page load
        document.addEventListener('DOMContentLoaded', function () {
            const toggleInput = document.getElementById('darkModeToggle');
            if (toggleInput) {
                toggleInput.checked = savedTheme === 'dark';
            }
        });
    </script>
</head>

<body class="min-h-screen bg-gray-50 font-inter transition-colors duration-300" data-theme-target="body">
    <div class="flex h-screen bg-gray-50 transition-colors duration-300" data-theme-target="container">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
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

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const menuToggle = document.getElementById('menu-toggle');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
            }

            if (menuToggle) {
                menuToggle.addEventListener('click', toggleSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', toggleSidebar);
            }

            // Close sidebar on escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                    toggleSidebar();
                }
            });

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