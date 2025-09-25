<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSettings;
use Symfony\Component\HttpFoundation\Response;

class LoadUserSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Load settings relationship if not already loaded
            if (!$user->relationLoaded('settings')) {
                $user->load('settings');
            }

            // Create settings if they don't exist
            if (!$user->settings) {
                $user->settings()->create(UserSettings::getDefaults());
                $user->load('settings'); // Reload the relationship
            }
        }

        return $next($request);
    }
}
