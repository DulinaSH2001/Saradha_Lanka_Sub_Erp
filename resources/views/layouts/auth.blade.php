<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Saradha Lanka ERP')</title>

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

    <!-- Dark Mode Script -->
    <script>
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>

    <style>
        .theme-transitioning * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
    </style>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-green-50 via-white to-green-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 font-inter">
    <!-- Dark Mode Toggle -->
    <div class="fixed top-6 right-6 z-50">
        <label class="theme-toggle shadow-lg">
            <input type="checkbox" id="darkModeToggle">
            <span class="theme-slider"></span>
        </label>
    </div>

    <!-- Background Pattern -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div
            class="absolute -top-1/2 -right-1/2 w-96 h-96 bg-green-100 dark:bg-green-900/20 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse">
        </div>
        <div class="absolute -bottom-1/2 -left-1/2 w-96 h-96 bg-green-200 dark:bg-green-800/20 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"
            style="animation-delay: 2s;"></div>
    </div>

    <!-- Main Container -->
    <div class="relative min-h-screen flex items-stretch">
        <!-- Left Side - Auth Form -->
        <div
            class="w-full lg:w-1/2 flex flex-col justify-center px-6 py-12 lg:px-16 xl:px-20 bg-white dark:bg-gray-900">
            <div class="mx-auto w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <div class="flex justify-center mb-4">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-2xl">SL</span>
                        </div>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Saradha Lanka ERP</h1>
                </div>

                <!-- Auth Form Content -->
                <div class="w-full">
                    @yield('content')
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
                    <p>&copy; {{ date('Y') }} Saradha Lanka. All rights reserved.</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Branding & Info -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-green-500 via-green-600 to-emerald-700 relative overflow-hidden min-h-full">
            <!-- Decorative Elements -->
            <div class="absolute inset-0">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-white/5 rounded-full"></div>
                <div class="absolute top-1/3 -right-20 w-40 h-40 bg-white/10 rounded-full"></div>
                <div class="absolute bottom-1/4 -left-20 w-32 h-32 bg-white/5 rounded-full"></div>
            </div>

            <!-- Content -->
            <div class="relative flex flex-col justify-center items-center text-center p-12 text-white">
                <div class="max-w-md">
                    <!-- Logo -->
                    <div class="flex justify-center mb-8">
                        <div
                            class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-3xl flex items-center justify-center shadow-2xl border border-white/20">
                            <span class="text-white font-bold text-4xl">SL</span>
                        </div>
                    </div>

                    <!-- Heading -->
                    <h1 class="text-4xl font-bold mb-4">Saradha Lanka</h1>
                    <h2 class="text-2xl font-semibold mb-8 text-green-100">ERP Management System</h2>

                    <!-- Description -->
                    <p class="text-lg leading-relaxed mb-8 text-green-50">
                        Streamline your business operations with our comprehensive Enterprise Resource Planning
                        solution.
                        Manage inventory, finances, and operations all in one place.
                    </p>

                    <!-- Features List -->
                    <div class="space-y-4 text-left">
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-green-200 rounded-full"></div>
                            <span class="text-green-50">Real-time inventory tracking</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-green-200 rounded-full"></div>
                            <span class="text-green-50">Financial management & reporting</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-green-200 rounded-full"></div>
                            <span class="text-green-50">Multi-user collaboration</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-green-200 rounded-full"></div>
                            <span class="text-green-50">Advanced analytics dashboard</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dark Mode Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const darkModeToggle = document.getElementById('darkModeToggle');
            const savedTheme = localStorage.getItem('theme') || 'light';

            // Set initial toggle state
            if (darkModeToggle) {
                darkModeToggle.checked = savedTheme === 'dark';
            }

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