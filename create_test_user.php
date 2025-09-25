<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';

// Use Laravel's environment
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

try {
    // Create a test user if it doesn't exist
    $userExists = DB::table('users')->where('email', 'test@example.com')->exists();

    if (!$userExists) {
        $userId = DB::table('users')->insertGetId([
            'name' => 'Test User',
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'position' => 'Developer',
            'phone' => '1234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        echo "Test user created with ID: $userId\n";
        echo "Email: test@example.com\n";
        echo "Password: password\n";

        // Create settings for the user
        DB::table('user_settings')->insert([
            'user_id' => $userId,
            'theme' => 'light',
            'notifications_email' => true,
            'notifications_sms' => false,
            'notifications_push' => true,
            'language' => 'en',
            'timezone' => 'UTC',
            'sidebar_collapsed' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        echo "User settings created.\n";
    } else {
        echo "Test user already exists.\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
