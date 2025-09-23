<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName() ?: ($googleUser->getNickname() ?: 'Google User'),
                'password' => Hash::make(bin2hex(random_bytes(16))),
            ]
        );

        // Persist google id if present
        if (method_exists($user, 'getAttribute') && $googleUser->getId()) {
            if (!isset($user->google_id) || $user->google_id !== $googleUser->getId()) {
                $user->google_id = $googleUser->getId();
                $user->save();
            }
        }

        $token = $user->createToken('api')->plainTextToken;

        $redirectUrl = url('/auth/google/callback/consume?token=' . urlencode($token));
        return redirect($redirectUrl);
    }
}


