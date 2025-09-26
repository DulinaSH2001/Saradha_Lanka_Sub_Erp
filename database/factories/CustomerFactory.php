<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customerType = fake()->randomElement(['company', 'individual']);
        $isCompany = $customerType === 'company';

        return [
            'company_name' => $isCompany
                ? fake()->company()
                : fake()->firstName() . ' ' . fake()->lastName(),
            'customer_type' => $customerType,
            'contact_person' => $isCompany ? fake()->name() : null,
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'mobile' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'country' => fake()->randomElement(['Sri Lanka', 'India', 'USA', 'UK', 'Australia']),
            'status' => fake()->randomElement(['active', 'active', 'active', 'inactive', 'pending']), // More active customers
            'credit_limit' => fake()->randomFloat(2, 50000, 1000000),
            'payment_terms_days' => fake()->randomElement([7, 15, 30, 45, 60, 90]),
            'tax_number' => fake()->optional()->numerify('###########V'),
            'notes' => fake()->optional()->paragraph(),
        ];
    }
}
