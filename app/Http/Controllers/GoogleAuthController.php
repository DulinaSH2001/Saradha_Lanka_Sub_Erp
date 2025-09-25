<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Extract name parts
            $fullName = $googleUser->getName() ?: ($googleUser->getNickname() ?: 'Google User');
            $nameParts = explode(' ', $fullName, 2);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $fullName,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'password' => Hash::make(bin2hex(random_bytes(16))),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar() ? $this->downloadAvatar($googleUser->getAvatar()) : null,
                ]
            );

            // Update google_id if it's not set or different
            if (!$user->google_id || $user->google_id !== $googleUser->getId()) {
                $user->update(['google_id' => $googleUser->getId()]);
            }

            // Create user settings if they don't exist
            if (!$user->settings) {
                $user->settings()->create(UserSettings::getDefaults());
            }

            // Log the user in using Laravel's session authentication
            Auth::login($user);

            return redirect()->route('dashboard')->with('status', 'Successfully signed in with Google!');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google authentication failed. Please try again.');
        }
    }

    /**
     * Download and store Google avatar (optional)
     */
    private function downloadAvatar($avatarUrl)
    {
        try {
            // You can implement avatar download logic here if needed
            // For now, we'll just return null to use initials
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}


