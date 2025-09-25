<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test user
        $user = User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'first_name' => 'Test',
                'last_name' => 'User',
                'password' => Hash::make('password'),
                'position' => 'Developer',
                'phone' => '1234567890',
            ]
        );

        // Create user settings if they don't exist
        if (!$user->settings) {
            $user->settings()->create(UserSettings::getDefaults());
        }

        $this->command->info('Test user created: test@example.com / password');
    }
}
