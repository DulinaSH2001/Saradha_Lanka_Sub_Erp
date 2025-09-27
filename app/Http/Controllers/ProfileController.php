<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show user profile page.
     */
    public function show()
    {
        $user = Auth::user();

        // Create settings if they don't exist
        if (!$user->settings) {
            $user->settings()->create(UserSettings::getDefaults());
        }

        return view('profile.show', compact('user'));
    }

    /**
     * Show settings page.
     */
    public function settings()
    {
        $user = Auth::user();

        // Create settings if they don't exist
        if (!$user->settings) {
            $user->settings()->create(UserSettings::getDefaults());
        }

        $settings = $user->settings;

        return view('profile.settings', compact('user', 'settings'));
    }

    /**
     * Update user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'employee_id' => 'nullable|string|max:50|unique:users,employee_id,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Update user settings.
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'notifications_enabled' => 'boolean',
            'email_notifications' => 'boolean',
            'browser_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'marketing_emails_enabled' => 'boolean',
            'security_alerts_enabled' => 'boolean',
            'auto_serial_number_enabled' => 'boolean',
            'auto_backup_enabled' => 'boolean',
            'auto_save_enabled' => 'boolean',
            'backup_enabled' => 'boolean',
            'data_retention_days' => 'integer|min:0|max:3650',
            'date_format' => 'string|in:Y-m-d,d/m/Y,m/d/Y,d-M-Y',
            'time_format' => 'string|in:H:i:s,h:i:s A,H:i',
            'currency_format' => 'string|max:10',
            'theme' => 'string|in:light,dark,auto',
            'language' => 'string|max:5',
            'timezone' => 'string|max:50',
            'records_per_page' => 'integer|min:10|max:100',
            'items_per_page' => 'integer|min:10|max:100',
            'sidebar_collapsed' => 'boolean',
            'two_factor_enabled' => 'boolean',
            'login_alerts_enabled' => 'boolean',
            'login_notifications_enabled' => 'boolean',
            'session_timeout_minutes' => 'integer|min:15|max:480',
            'session_timeout' => 'integer|min:15|max:480',
            'company_name' => 'nullable|string|max:255',
            'signature' => 'nullable|string|max:1000',
        ]);

        // Handle theme separately - save to cookies instead of database
        $themeCookie = null;
        if (isset($validated['theme'])) {
            $themeCookie = cookie('user_theme', $validated['theme'], 60 * 24 * 365);
            unset($validated['theme']); // Remove from database update
        }

        // Convert checkboxes to boolean (they won't be in request if unchecked)
        $booleanFields = [
            'notifications_enabled',
            'email_notifications',
            'browser_notifications',
            'sms_notifications',
            'marketing_emails_enabled',
            'security_alerts_enabled',
            'auto_serial_number_enabled',
            'auto_backup_enabled',
            'auto_save_enabled',
            'backup_enabled',
            'sidebar_collapsed',
            'two_factor_enabled',
            'login_alerts_enabled',
            'login_notifications_enabled',
        ];

        foreach ($booleanFields as $field) {
            $validated[$field] = $request->has($field);
        }

        // Create settings if they don't exist
        if (!$user->settings) {
            $user->settings()->create(UserSettings::getDefaults());
        }

        $user->settings->update($validated);

        $response = redirect()->route('profile.settings')
            ->with('success', 'Settings updated successfully!');

        // Add theme cookie if it was set
        if ($themeCookie) {
            $response = $response->cookie($themeCookie);
        }

        return $response;
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Password updated successfully!');
    }

    /**
     * Handle authentication.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => route('dashboard')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'The provided credentials do not match our records.'
        ], 401);
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'first_name' => $validated['first_name'] ?? null,
            'last_name' => $validated['last_name'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Create default settings for the user
        $user->settings()->create(UserSettings::getDefaults());

        Auth::login($user);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'redirect' => route('dashboard')
        ]);
    }

    /**
     * Get user theme preference from cookie.
     */
    public function getUserTheme(Request $request)
    {
        return $request->cookie('user_theme', 'light'); // Default to 'light'
    }

    /**
     * Update user theme preference.
     */
    public function updateTheme(Request $request)
    {
        $validated = $request->validate([
            'theme' => ['required', 'in:light,dark'],
        ]);

        // Save theme preference in cookie (expires in 1 year)
        $cookie = cookie('user_theme', $validated['theme'], 60 * 24 * 365);

        return response()->json([
            'success' => true,
            'message' => 'Theme preference saved'
        ])->cookie($cookie);
    }

    /**
     * Handle user logout.
     */
    public function logout(Request $request)
    {
        try {
            // Clear all authentication
            Auth::guard('web')->logout();

            // Invalidate the session completely
            $request->session()->invalidate();

            // Regenerate CSRF token
            $request->session()->regenerateToken();

        } catch (\Exception $e) {
            // If anything fails, still redirect to login
            \Log::error('Logout error: ' . $e->getMessage());
        }

        // Create response with cache prevention headers
        $response = redirect()->route('login')->with('status', 'You have been logged out successfully.');
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, private');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
}
