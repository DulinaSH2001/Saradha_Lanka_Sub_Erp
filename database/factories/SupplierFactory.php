<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyTypes = ['corporation', 'partnership', 'sole_proprietorship', 'llc', 'other'];
        $categories = ['material', 'service', 'both'];
        $countries = ['Sri Lanka', 'India', 'China', 'Singapore', 'UAE', 'USA', 'Germany', 'Japan'];
        $cities = ['Colombo', 'Kandy', 'Galle', 'Jaffna', 'Negombo', 'Kurunegala', 'Anuradhapura', 'Ratnapura'];

        $company = $this->faker->company();
        $contactPerson = $this->faker->name();

        return [
            'name' => $company,
            'code' => 'SUP-' . strtoupper($this->faker->unique()->bothify('???###')),
            'company_name' => $this->faker->optional(0.8)->boolean() ? $company : null,
            'company_type' => $this->faker->randomElement($companyTypes),
            'category' => $this->faker->randomElement($categories),
            'contact_person' => $this->faker->optional(0.9)->boolean() ? $contactPerson : null,
            'designation' => $this->faker->optional(0.7)->jobTitle(),
            'email' => $this->faker->optional(0.8)->companyEmail(),
            'phone' => $this->faker->optional(0.9)->phoneNumber(),
            'mobile' => $this->faker->optional(0.7)->phoneNumber(),
            'fax' => $this->faker->optional(0.3)->phoneNumber(),
            'website' => $this->faker->optional(0.5)->url(),
            'address_line_1' => $this->faker->optional(0.9)->streetAddress(),
            'address_line_2' => $this->faker->optional(0.4)->secondaryAddress(),
            'city' => $this->faker->optional(0.8)->randomElement($cities),
            'state' => $this->faker->optional(0.7)->state(),
            'postal_code' => $this->faker->optional(0.7)->postcode(),
            'country' => $this->faker->randomElement($countries),
            'tax_number' => $this->faker->optional(0.6)->bothify('TAX-########'),
            'registration_number' => $this->faker->optional(0.7)->bothify('REG-########'),
            'payment_terms' => $this->faker->optional(0.6)->randomElement([
                'Net 30 days',
                'Net 15 days',
                'Due on receipt',
                '2/10 Net 30',
                'Net 45 days',
                'Cash on delivery',
                'Advance payment required'
            ]),
            'credit_limit' => $this->faker->optional(0.7)->randomFloat(2, 10000, 500000),
            'credit_period' => $this->faker->optional(0.7)->numberBetween(15, 90),
            'discount_percentage' => $this->faker->optional(0.5)->randomFloat(2, 2, 15),
            'bank_name' => $this->faker->optional(0.6)->randomElement([
                'Bank of Ceylon',
                'People\'s Bank',
                'Commercial Bank',
                'Hatton National Bank',
                'Sampath Bank',
                'DFCC Bank',
                'NDB Bank'
            ]),
            'bank_account_number' => $this->faker->optional(0.6)->bothify('##########'),
            'bank_routing_number' => $this->faker->optional(0.6)->bothify('######'),
            'rating' => $this->faker->optional(0.8)->numberBetween(1, 5),
            'notes' => $this->faker->optional(0.5)->text(200),
            'is_active' => $this->faker->boolean(90),
            'is_verified' => $this->faker->boolean(70),
            'is_preferred' => $this->faker->boolean(30),
        ];
    }

    /**
     * Indicate that the supplier is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the supplier is verified.
     */
    public function verified(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_verified' => true,
        ]);
    }

    /**
     * Indicate that the supplier is preferred.
     */
    public function preferred(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_preferred' => true,
            'is_verified' => true, // Preferred suppliers should be verified
        ]);
    }

    /**
     * Indicate that the supplier is a material supplier.
     */
    public function materialSupplier(): static
    {
        return $this->state(fn(array $attributes) => [
            'category' => 'material',
        ]);
    }

    /**
     * Indicate that the supplier is a service provider.
     */
    public function serviceProvider(): static
    {
        return $this->state(fn(array $attributes) => [
            'category' => 'service',
        ]);
    }

    /**
     * Indicate that the supplier provides both materials and services.
     */
    public function bothProvider(): static
    {
        return $this->state(fn(array $attributes) => [
            'category' => 'both',
        ]);
    }

    /**
     * Indicate that the supplier is a corporation.
     */
    public function corporation(): static
    {
        return $this->state(fn(array $attributes) => [
            'company_type' => 'corporation',
        ]);
    }

    /**
     * Create a supplier with high rating.
     */
    public function highRating(): static
    {
        return $this->state(fn(array $attributes) => [
            'rating' => $this->faker->numberBetween(4, 5),
            'is_verified' => true,
        ]);
    }

    /**
     * Create a supplier with low rating.
     */
    public function lowRating(): static
    {
        return $this->state(fn(array $attributes) => [
            'rating' => $this->faker->numberBetween(1, 2),
            'is_verified' => false,
        ]);
    }
}
