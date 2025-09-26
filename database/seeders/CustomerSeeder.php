<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 25 customers for testing
        Customer::factory(25)->create();

        // Create a few specific test customers
        Customer::create([
            'company_name' => 'Acme Corporation',
            'customer_type' => 'company',
            'contact_person' => 'John Doe',
            'email' => 'john@acmecorp.com',
            'phone' => '+94 11 234 5678',
            'mobile' => '+94 77 123 4567',
            'address' => '123 Main Street, Level 5',
            'city' => 'Colombo',
            'postal_code' => '00100',
            'country' => 'Sri Lanka',
            'status' => 'active',
            'credit_limit' => 500000.00,
            'payment_terms_days' => 30,
            'tax_number' => '123456789V',
            'notes' => 'Major client - handle with priority',
        ]);

        Customer::create([
            'company_name' => 'Tech Solutions Ltd',
            'customer_type' => 'company',
            'contact_person' => 'Jane Smith',
            'email' => 'jane@techsolutions.lk',
            'phone' => '+94 11 987 6543',
            'mobile' => '+94 76 456 7890',
            'address' => '456 Business Park, Rajagiriya',
            'city' => 'Rajagiriya',
            'postal_code' => '10100',
            'country' => 'Sri Lanka',
            'status' => 'active',
            'credit_limit' => 750000.00,
            'payment_terms_days' => 45,
            'tax_number' => '987654321V',
            'notes' => 'Long-term partner since 2020',
        ]);

        Customer::create([
            'company_name' => 'Sarah Fernando',
            'customer_type' => 'individual',
            'contact_person' => null,
            'email' => 'sarah.fernando@gmail.com',
            'phone' => null,
            'mobile' => '+94 71 234 5678',
            'address' => '789 Temple Road',
            'city' => 'Kandy',
            'postal_code' => '20000',
            'country' => 'Sri Lanka',
            'status' => 'pending',
            'credit_limit' => 100000.00,
            'payment_terms_days' => 15,
            'tax_number' => null,
            'notes' => 'New individual customer - verification pending',
        ]);
    }
}
