@extends('layouts.app')

@section('title', 'Account Settings')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Settings Header -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Account Settings</h1>
                    <p class="text-sm text-gray-600">Manage your preferences and system settings</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('profile.show') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <i class="fas fa-user w-4 h-4 mr-2"></i>
                        My Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle w-5 h-5 mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Settings Form -->
    <form method="POST" action="{{ route('profile.settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Notification Settings -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-bell w-5 h-5 mr-2 text-blue-600"></i>
                    Notification Settings
                </h2>
                <p class="text-sm text-gray-600">Configure how and when you receive notifications</p>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Email Notifications -->
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="notifications_enabled" value="0">
                            <input id="notifications_enabled" name="notifications_enabled" type="checkbox" value="1"
                                   {{ old('notifications_enabled', $settings->notifications_enabled ?? true) ? 'checked' : '' }}
                                   class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="notifications_enabled" class="font-medium text-gray-700">Email Notifications</label>
                            <p class="text-gray-500">Receive email notifications for important updates</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="browser_notifications" value="0">
                            <input id="browser_notifications" name="browser_notifications" type="checkbox" value="1"
                                   {{ old('browser_notifications', $settings->browser_notifications ?? true) ? 'checked' : '' }}
                                   class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="browser_notifications" class="font-medium text-gray-700">Push Notifications</label>
                            <p class="text-gray-500">Receive browser push notifications</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="sms_notifications" value="0">
                            <input id="sms_notifications" name="sms_notifications" type="checkbox" value="1"
                                   {{ old('sms_notifications', $settings->sms_notifications ?? false) ? 'checked' : '' }}
                                   class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="sms_notifications" class="font-medium text-gray-700">SMS Notifications</label>
                            <p class="text-gray-500">Receive SMS for critical alerts</p>
                        </div>
                    </div>
                </div>

                <!-- Marketing Communications -->
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="marketing_emails_enabled" value="0">
                            <input id="marketing_emails_enabled" name="marketing_emails_enabled" type="checkbox" value="1"
                                   {{ old('marketing_emails_enabled', $settings->marketing_emails_enabled ?? true) ? 'checked' : '' }}
                                   class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="marketing_emails_enabled" class="font-medium text-gray-700">Marketing Emails</label>
                            <p class="text-gray-500">Receive updates about new features</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="security_alerts_enabled" value="0">
                            <input id="security_alerts_enabled" name="security_alerts_enabled" type="checkbox" value="1"
                                   {{ old('security_alerts_enabled', $settings->security_alerts_enabled ?? true) ? 'checked' : '' }}
                                   class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="security_alerts_enabled" class="font-medium text-gray-700">Security Alerts</label>
                            <p class="text-gray-500">Important security notifications</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Preferences -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-cogs w-5 h-5 mr-2 text-green-600"></i>
                    System Preferences
                </h2>
                <p class="text-sm text-gray-600">Configure system behavior and automation</p>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- System Features -->
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="auto_serial_number_enabled" value="0">
                            <input id="auto_serial_number_enabled" name="auto_serial_number_enabled" type="checkbox" value="1"
                                   {{ old('auto_serial_number_enabled', $settings->auto_serial_number_enabled ?? true) ? 'checked' : '' }}
                                   class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="auto_serial_number_enabled" class="font-medium text-gray-700">Auto Serial Number</label>
                            <p class="text-gray-500">Automatically generate serial numbers for new items</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="auto_save_enabled" value="0">
                            <input id="auto_save_enabled" name="auto_save_enabled" type="checkbox" value="1"
                                   {{ old('auto_save_enabled', $settings->auto_save_enabled ?? true) ? 'checked' : '' }}
                                   class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="auto_save_enabled" class="font-medium text-gray-700">Auto Save</label>
                            <p class="text-gray-500">Automatically save changes while working</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="backup_enabled" value="0">
                            <input id="backup_enabled" name="backup_enabled" type="checkbox" value="1"
                                   {{ old('backup_enabled', $settings->backup_enabled ?? false) ? 'checked' : '' }}
                                   class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="backup_enabled" class="font-medium text-gray-700">Automatic Backups</label>
                            <p class="text-gray-500">Enable regular data backups</p>
                        </div>
                    </div>
                </div>

                <!-- Data Management -->
                <div class="space-y-4">
                    <div>
                        <label for="data_retention_days" class="block text-sm font-medium text-gray-700 mb-2">Data Retention (Days)</label>
                        <select name="data_retention_days" id="data_retention_days"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="30" {{ old('data_retention_days', $settings->data_retention_days ?? 30) == 30 ? 'selected' : '' }}>30 Days</option>
                            <option value="90" {{ old('data_retention_days', $settings->data_retention_days ?? 30) == 90 ? 'selected' : '' }}>90 Days</option>
                            <option value="180" {{ old('data_retention_days', $settings->data_retention_days ?? 30) == 180 ? 'selected' : '' }}>6 Months</option>
                            <option value="365" {{ old('data_retention_days', $settings->data_retention_days ?? 30) == 365 ? 'selected' : '' }}>1 Year</option>
                            <option value="0" {{ old('data_retention_days', $settings->data_retention_days ?? 30) == 0 ? 'selected' : '' }}>Never Delete</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Interface Settings -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-palette w-5 h-5 mr-2 text-purple-600"></i>
                    User Interface
                </h2>
                <p class="text-sm text-gray-600">Customize your interface appearance and behavior</p>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Theme Settings -->
                <div>
                    <label for="theme" class="block text-sm font-medium text-gray-700 mb-2">Theme</label>
                    <select name="theme" id="theme"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="light" {{ old('theme', $settings->theme ?? 'light') == 'light' ? 'selected' : '' }}>Light</option>
                        <option value="dark" {{ old('theme', $settings->theme ?? 'light') == 'dark' ? 'selected' : '' }}>Dark</option>
                        <option value="auto" {{ old('theme', $settings->theme ?? 'light') == 'auto' ? 'selected' : '' }}>Auto (System)</option>
                    </select>
                </div>

                <!-- Language -->
                <div>
                    <label for="language" class="block text-sm font-medium text-gray-700 mb-2">Language</label>
                    <select name="language" id="language"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="en" {{ old('language', $settings->language ?? 'en') == 'en' ? 'selected' : '' }}>English</option>
                        <option value="es" {{ old('language', $settings->language ?? 'en') == 'es' ? 'selected' : '' }}>Español</option>
                        <option value="fr" {{ old('language', $settings->language ?? 'en') == 'fr' ? 'selected' : '' }}>Français</option>
                        <option value="de" {{ old('language', $settings->language ?? 'en') == 'de' ? 'selected' : '' }}>Deutsch</option>
                        <option value="it" {{ old('language', $settings->language ?? 'en') == 'it' ? 'selected' : '' }}>Italiano</option>
                        <option value="pt" {{ old('language', $settings->language ?? 'en') == 'pt' ? 'selected' : '' }}>Português</option>
                        <option value="zh" {{ old('language', $settings->language ?? 'en') == 'zh' ? 'selected' : '' }}>中文</option>
                        <option value="ja" {{ old('language', $settings->language ?? 'en') == 'ja' ? 'selected' : '' }}>日本語</option>
                    </select>
                </div>

                <!-- Timezone -->
                <div>
                    <label for="timezone" class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                    <select name="timezone" id="timezone"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="UTC" {{ old('timezone', $settings->timezone ?? 'UTC') == 'UTC' ? 'selected' : '' }}>UTC</option>
                        <option value="America/New_York" {{ old('timezone', $settings->timezone ?? 'UTC') == 'America/New_York' ? 'selected' : '' }}>Eastern Time (ET)</option>
                        <option value="America/Chicago" {{ old('timezone', $settings->timezone ?? 'UTC') == 'America/Chicago' ? 'selected' : '' }}>Central Time (CT)</option>
                        <option value="America/Denver" {{ old('timezone', $settings->timezone ?? 'UTC') == 'America/Denver' ? 'selected' : '' }}>Mountain Time (MT)</option>
                        <option value="America/Los_Angeles" {{ old('timezone', $settings->timezone ?? 'UTC') == 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time (PT)</option>
                        <option value="Europe/London" {{ old('timezone', $settings->timezone ?? 'UTC') == 'Europe/London' ? 'selected' : '' }}>London (GMT)</option>
                        <option value="Europe/Paris" {{ old('timezone', $settings->timezone ?? 'UTC') == 'Europe/Paris' ? 'selected' : '' }}>Paris (CET)</option>
                        <option value="Europe/Berlin" {{ old('timezone', $settings->timezone ?? 'UTC') == 'Europe/Berlin' ? 'selected' : '' }}>Berlin (CET)</option>
                        <option value="Asia/Tokyo" {{ old('timezone', $settings->timezone ?? 'UTC') == 'Asia/Tokyo' ? 'selected' : '' }}>Tokyo (JST)</option>
                        <option value="Asia/Shanghai" {{ old('timezone', $settings->timezone ?? 'UTC') == 'Asia/Shanghai' ? 'selected' : '' }}>Shanghai (CST)</option>
                        <option value="Asia/Kolkata" {{ old('timezone', $settings->timezone ?? 'UTC') == 'Asia/Kolkata' ? 'selected' : '' }}>Mumbai (IST)</option>
                        <option value="Australia/Sydney" {{ old('timezone', $settings->timezone ?? 'UTC') == 'Australia/Sydney' ? 'selected' : '' }}>Sydney (AEST)</option>
                    </select>
                </div>

                <!-- Date Format -->
                <div>
                    <label for="date_format" class="block text-sm font-medium text-gray-700 mb-2">Date Format</label>
                    <select name="date_format" id="date_format"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="Y-m-d" {{ old('date_format', $settings->date_format ?? 'Y-m-d') == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                        <option value="m/d/Y" {{ old('date_format', $settings->date_format ?? 'Y-m-d') == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
                        <option value="d/m/Y" {{ old('date_format', $settings->date_format ?? 'Y-m-d') == 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY</option>
                        <option value="d-M-Y" {{ old('date_format', $settings->date_format ?? 'Y-m-d') == 'd-M-Y' ? 'selected' : '' }}>DD-MMM-YYYY</option>
                    </select>
                </div>

                <!-- Items Per Page -->
                <div>
                    <label for="items_per_page" class="block text-sm font-medium text-gray-700 mb-2">Items Per Page</label>
                    <select name="items_per_page" id="items_per_page"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                        <option value="10" {{ old('items_per_page', $settings->items_per_page ?? 25) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ old('items_per_page', $settings->items_per_page ?? 25) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ old('items_per_page', $settings->items_per_page ?? 25) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ old('items_per_page', $settings->items_per_page ?? 25) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>

                <!-- Sidebar Collapsed -->
                <div class="flex items-center">
                    <div class="flex items-center h-5">
                        <input type="hidden" name="sidebar_collapsed" value="0">
                        <input id="sidebar_collapsed" name="sidebar_collapsed" type="checkbox" value="1"
                               {{ old('sidebar_collapsed', $settings->sidebar_collapsed ?? false) ? 'checked' : '' }}
                               class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="sidebar_collapsed" class="font-medium text-gray-700">Collapse Sidebar</label>
                        <p class="text-gray-500">Start with sidebar collapsed</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-shield-alt w-5 h-5 mr-2 text-red-600"></i>
                    Security Settings
                </h2>
                <p class="text-sm text-gray-600">Manage your account security and privacy preferences</p>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Security Features -->
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="two_factor_enabled" value="0">
                            <input id="two_factor_enabled" name="two_factor_enabled" type="checkbox" value="1"
                                   {{ old('two_factor_enabled', $settings->two_factor_enabled ?? false) ? 'checked' : '' }}
                                   class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="two_factor_enabled" class="font-medium text-gray-700">Two-Factor Authentication</label>
                            <p class="text-gray-500">Add an extra layer of security to your account</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="hidden" name="login_notifications_enabled" value="0">
                            <input id="login_notifications_enabled" name="login_notifications_enabled" type="checkbox" value="1"
                                   {{ old('login_notifications_enabled', $settings->login_notifications_enabled ?? true) ? 'checked' : '' }}
                                   class="focus:ring-green-500 h-4 w-4 text-green-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="login_notifications_enabled" class="font-medium text-gray-700">Login Notifications</label>
                            <p class="text-gray-500">Get notified of new login attempts</p>
                        </div>
                    </div>
                </div>

                <!-- Session Management -->
                <div class="space-y-4">
                    <div>
                        <label for="session_timeout" class="block text-sm font-medium text-gray-700 mb-2">Session Timeout (Minutes)</label>
                        <select name="session_timeout" id="session_timeout"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="15" {{ old('session_timeout', $settings->session_timeout ?? 60) == 15 ? 'selected' : '' }}>15 Minutes</option>
                            <option value="30" {{ old('session_timeout', $settings->session_timeout ?? 60) == 30 ? 'selected' : '' }}>30 Minutes</option>
                            <option value="60" {{ old('session_timeout', $settings->session_timeout ?? 60) == 60 ? 'selected' : '' }}>1 Hour</option>
                            <option value="120" {{ old('session_timeout', $settings->session_timeout ?? 60) == 120 ? 'selected' : '' }}>2 Hours</option>
                            <option value="480" {{ old('session_timeout', $settings->session_timeout ?? 60) == 480 ? 'selected' : '' }}>8 Hours</option>
                            <option value="0" {{ old('session_timeout', $settings->session_timeout ?? 60) == 0 ? 'selected' : '' }}>Never</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Save Settings</h3>
                    <p class="text-sm text-gray-600">Your preferences will be applied immediately</p>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="window.location.reload()"
                            class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <i class="fas fa-undo w-4 h-4 mr-2"></i>
                        Reset
                    </button>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                        <i class="fas fa-save w-4 h-4 mr-2"></i>
                        Save Settings
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
