@extends('layouts.auth')

@section('title', 'Sign In - Saradha Lanka ERP')

@section('content')
    <div class="space-y-8">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">
                Welcome Back
            </h2>
            <p class="text-gray-600 text-lg">
                Sign in to your account to continue
            </p>
        </div>

        <!-- Alert Messages -->
        <div id="alert" class="hidden rounded-lg p-4 mb-6" role="alert">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg id="alert-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"></svg>
                </div>
                <div class="ml-3">
                    <p id="alert-message" class="text-sm font-medium"></p>
                </div>
            </div>
        </div>

        <!-- Google Sign In -->
        <div class="space-y-4">
            <a href="{{ route('google.redirect') }}"
                class="w-full flex justify-center items-center px-4 py-3 border border-gray-300 rounded-lg shadow-sm bg-white text-gray-700 hover:bg-gray-50 transition-colors duration-200 group">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google"
                    class="w-5 h-5 mr-3">
                <span class="font-medium">Continue with Google</span>
            </a>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">or continue with
                        email</span>
                </div>
            </div>
        </div>

        <!-- Login Form -->
        <form id="loginForm" class="space-y-6">
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                        Address</label>
                    <input type="email" id="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-200"
                        placeholder="Enter your email" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-200"
                        placeholder="Enter your password" required minlength="8">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember"
                        class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>
                <a href="/forgot-password"
                    class="text-sm text-green-600 hover:text-green-800 font-medium transition-colors duration-200">
                    Forgot password?
                </a>
            </div>

            <button type="submit" id="submitBtn"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-medium transition-colors duration-200 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex justify-center items-center">
                <span id="submitText">Sign In</span>
                <svg id="loadingSpinner" class="hidden animate-spin ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </button>
        </form>

        <!-- Sign Up Link -->
        <div class="text-center pt-6 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                Don't have an account?
                <a href="/register" class="font-medium text-green-600 hover:text-green-800 transition-colors duration-200">
                    Create one now
                </a>
            </p>
        </div>
    </div>

    @push('scripts')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            $(document).ready(function () {
                // Setup CSRF token for AJAX requests
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                function setLoading(loading) {
                    const submitBtn = document.getElementById('submitBtn');
                    const submitText = document.getElementById('submitText');
                    const loadingSpinner = document.getElementById('loadingSpinner');

                    submitBtn.disabled = loading;

                    if (loading) {
                        submitText.textContent = 'Signing In...';
                        loadingSpinner.classList.remove('hidden');
                        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                    } else {
                        submitText.textContent = 'Sign In';
                        loadingSpinner.classList.add('hidden');
                        submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                    }
                }

                function showAlert(type, message) {
                    const alert = document.getElementById('alert');
                    const alertIcon = document.getElementById('alert-icon');
                    const alertMessage = document.getElementById('alert-message');

                    // Reset classes
                    alert.className = 'hidden rounded-lg p-4 mb-6';

                    if (type === 'success') {
                        alert.classList.add('bg-green-50', 'border', 'border-green-200');
                        alertMessage.className = 'text-sm font-medium text-green-800';
                        alertIcon.className = 'w-5 h-5 text-green-400';
                        alertIcon.innerHTML = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>';
                    } else {
                        alert.classList.add('bg-red-50', 'border', 'border-red-200');
                        alertMessage.className = 'text-sm font-medium text-red-800';
                        alertIcon.className = 'w-5 h-5 text-red-400';
                        alertIcon.innerHTML = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>';
                    }

                    alertMessage.textContent = message;
                    alert.classList.remove('hidden');

                    // Auto hide success messages
                    if (type === 'success') {
                        setTimeout(() => {
                            alert.classList.add('hidden');
                        }, 5000);
                    }
                }

                function hideAlert() {
                    const alert = document.getElementById('alert');
                    alert.classList.add('hidden');
                }

                $('#loginForm').on('submit', function (e) {
                    e.preventDefault();

                    const email = $('#email').val();
                    const password = $('#password').val();
                    const remember = $('#remember').is(':checked');

                    setLoading(true);
                    hideAlert();

                    $.ajax({
                        url: '{{ route("login.post") }}',
                        method: 'POST',
                        data: {
                            email: email,
                            password: password,
                            remember: remember
                        },
                        success: function (response) {
                            if (response.success) {
                                showAlert('success', response.message || 'Login successful! Redirecting...');
                                setTimeout(() => {
                                    window.location.href = response.redirect || '{{ route("dashboard") }}';
                                }, 1500);
                            } else {
                                showAlert('error', response.message || 'Login failed. Please try again.');
                            }
                        },
                        error: function (xhr) {
                            let message = 'Login failed. Please try again.';

                            if (xhr.responseJSON) {
                                if (xhr.responseJSON.message) {
                                    message = xhr.responseJSON.message;
                                } else if (xhr.responseJSON.errors) {
                                    const firstKey = Object.keys(xhr.responseJSON.errors)[0];
                                    if (firstKey) {
                                        message = xhr.responseJSON.errors[firstKey][0];
                                    }
                                }
                            }

                            showAlert('error', message);
                        },
                        complete: function () {
                            setLoading(false);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection