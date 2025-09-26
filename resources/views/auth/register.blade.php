@extends('layouts.auth')

@section('title', 'Create Account - Saradha Lanka ERP')

@section('content')
    <div class="space-y-8">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">
                Create Your Account
            </h2>
            <p class="text-gray-600 text-lg">
                Join Saradha Lanka ERP System today
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

        <!-- Google Sign Up -->
        <div class="space-y-4">
            <a href="/auth/google/redirect"
                class="w-full flex justify-center items-center px-4 py-3 border border-gray-300 rounded-lg shadow-sm bg-white text-gray-700 hover:bg-gray-50 transition-colors duration-200 group">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google"
                    class="w-5 h-5 mr-3">
                <span class="font-medium">Sign up with Google</span>
            </a>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">or create account with
                        email</span>
                </div>
            </div>
        </div>

        <!-- Registration Form -->
        <form id="registerForm" class="space-y-6">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full
                        Name</label>
                    <input type="text" id="name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white text-black transition-colors duration-200"
                        placeholder="Enter your full name" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email
                        Address</label>
                    <input type="email" id="email"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white text-black transition-colors duration-200"
                        placeholder="Enter your email" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white text-black transition-colors duration-200"
                        placeholder="Create a strong password" required minlength="8">
                    <p class="mt-2 text-xs text-gray-500">Password must be at least 8 characters long</p>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm
                        Password</label>
                    <input type="password" id="password_confirmation"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white text-black transition-colors duration-200"
                        placeholder="Confirm your password" required>
                </div>
            </div>

            <div class="flex items-start space-x-3">
                <div class="flex items-center h-5 mt-0.5">
                    <input type="checkbox" id="terms"
                        class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500 bg-white" required>
                </div>
                <label for="terms" class="text-sm text-gray-600">
                    I agree to the
                    <a href="/terms"
                        class="text-green-600 hover:text-green-800 font-medium transition-colors duration-200">Terms
                        of Service</a>
                    and
                    <a href="/privacy"
                        class="text-green-600 hover:text-green-800 font-medium transition-colors duration-200">Privacy
                        Policy</a>
                </label>
            </div>

            <button type="submit" id="submitBtn"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-medium transition-colors duration-200 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex justify-center items-center">
                <span id="submitText">Create Account</span>
                <svg id="loadingSpinner" class="hidden animate-spin ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </button>
        </form>

        <!-- Sign In Link -->
        <div class="text-center pt-6 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="/login" class="font-medium text-green-600 hover:text-green-800 transition-colors duration-200">
                    Sign in here
                </a>
            </p>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            (function () {
                const apiBase = '/api';
                const registerEndpoint = apiBase + '/register';
                const dashboardUrl = '/dashboard';

                function setLoading(loading) {
                    const submitBtn = document.getElementById('submitBtn');
                    const submitText = document.getElementById('submitText');
                    const loadingSpinner = document.getElementById('loadingSpinner');

                    submitBtn.disabled = loading;

                    if (loading) {
                        submitText.textContent = 'Creating Account...';
                        loadingSpinner.classList.remove('hidden');
                        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
                    } else {
                        submitText.textContent = 'Create Account';
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

                function validateForm() {
                    const password = document.getElementById('password').value;
                    const passwordConfirmation = document.getElementById('password_confirmation').value;
                    const terms = document.getElementById('terms').checked;

                    if (password !== passwordConfirmation) {
                        showAlert('error', 'Passwords do not match.');
                        return false;
                    }

                    if (password.length < 8) {
                        showAlert('error', 'Password must be at least 8 characters long.');
                        return false;
                    }

                    if (!terms) {
                        showAlert('error', 'You must agree to the Terms of Service and Privacy Policy.');
                        return false;
                    }

                    return true;
                }

                document.getElementById('registerForm').addEventListener('submit', function (e) {
                    e.preventDefault();

                    if (!validateForm()) {
                        return;
                    }

                    const name = document.getElementById('name').value;
                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;
                    const password_confirmation = document.getElementById('password_confirmation').value;

                    setLoading(true);
                    hideAlert();

                    $.ajax({
                        url: registerEndpoint,
                        method: 'POST',
                        contentType: 'application/json; charset=utf-8',
                        dataType: 'json',
                        data: JSON.stringify({
                            name: name,
                            email: email,
                            password: password,
                            password_confirmation: password_confirmation
                        }),
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        success: function (res) {
                            if (res && res.token) {
                                localStorage.setItem('auth_token', res.token);
                                try {
                                    localStorage.setItem('auth_user', JSON.stringify(res.user || {}));
                                } catch (e) {
                                    console.log('Failed to store user data');
                                }

                                showAlert('success', 'Account created successfully! Redirecting...');

                                setTimeout(() => {
                                    window.location.href = dashboardUrl;
                                }, 1500);
                            } else {
                                showAlert('error', 'Unexpected response from server.');
                            }
                        },
                        error: function (xhr) {
                            let message = 'Registration failed. Please try again.';

                            if (xhr && xhr.responseJSON) {
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

                // Real-time password confirmation validation
                document.getElementById('password_confirmation').addEventListener('input', function () {
                    const password = document.getElementById('password').value;
                    const confirmation = this.value;

                    if (confirmation && password !== confirmation) {
                        this.classList.add('border-red-300');
                        this.classList.remove('border-gray-300');
                    } else {
                        this.classList.remove('border-red-300');
                        this.classList.add('border-gray-300');
                    }
                });

                // Real-time password strength indicator
                document.getElementById('password').addEventListener('input', function () {
                    const password = this.value;
                    const confirmation = document.getElementById('password_confirmation').value;

                    if (confirmation && password !== confirmation) {
                        document.getElementById('password_confirmation').classList.add('border-red-300');
                        document.getElementById('password_confirmation').classList.remove('border-gray-300');
                    } else if (confirmation) {
                        document.getElementById('password_confirmation').classList.remove('border-red-300');
                        document.getElementById('password_confirmation').classList.add('border-gray-300');
                    }
                });
            })();
        </script>
    @endpush
@endsection