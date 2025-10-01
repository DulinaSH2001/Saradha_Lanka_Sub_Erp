<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 30 regular suppliers
        Supplier::factory()->count(30)->create();

        // Create 5 inactive suppliers
        Supplier::factory()->count(5)->inactive()->create();

        // Create 10 verified suppliers
        Supplier::factory()->count(10)->verified()->create();

        // Create 8 preferred suppliers
        Supplier::factory()->count(8)->preferred()->create();

        // Create 12 material suppliers
        Supplier::factory()->count(12)->materialSupplier()->create();

        // Create 8 service providers
        Supplier::factory()->count(8)->serviceProvider()->create();

        // Create 5 suppliers that provide both
        Supplier::factory()->count(5)->bothProvider()->create();

        // Create 6 corporations
        Supplier::factory()->count(6)->corporation()->create();

        // Create 5 high-rated suppliers
        Supplier::factory()->count(5)->highRating()->create();

        // Create some specific sample suppliers
        Supplier::create([
            'name' => 'Tech Solutions Lanka (Pvt) Ltd',
            'code' => 'SUP-TECH001',
            'company_name' => 'Tech Solutions Lanka (Pvt) Ltd',
            'company_type' => 'corporation',
            'category' => 'material',
            'contact_person' => 'Rajesh Perera',
            'designation' => 'Sales Manager',
            'email' => 'orders@techsolutions.lk',
            'phone' => '+94 11 234 5678',
            'mobile' => '+94 77 123 4567',
            'website' => 'https://www.techsolutions.lk',
            'address_line_1' => '123 Galle Road',
            'address_line_2' => 'Bambalapitiya',
            'city' => 'Colombo',
            'state' => 'Western',
            'postal_code' => '00400',
            'country' => 'Sri Lanka',
            'tax_number' => 'TAX-12345678',
            'registration_number' => 'REG-87654321',
            'payment_terms' => 'Net 30 days',
            'credit_limit' => 500000.00,
            'credit_period' => 30,
            'discount_percentage' => 5.00,
            'bank_name' => 'Commercial Bank',
            'bank_account_number' => '1234567890',
            'bank_routing_number' => '7056',
            'rating' => 5,
            'notes' => 'Reliable supplier for IT equipment and software solutions. Excellent customer service and competitive pricing.',
            'is_active' => true,
            'is_verified' => true,
            'is_preferred' => true,
        ]);

        Supplier::create([
            'name' => 'Office Furniture Co.',
            'code' => 'SUP-FURN001',
            'company_name' => 'Ceylon Office Furniture Company',
            'company_type' => 'partnership',
            'category' => 'material',
            'contact_person' => 'Saman Silva',
            'designation' => 'Business Development Manager',
            'email' => 'sales@officefurniture.lk',
            'phone' => '+94 11 567 8901',
            'mobile' => '+94 71 567 8901',
            'website' => 'https://www.officefurniture.lk',
            'address_line_1' => '456 Kandy Road',
            'city' => 'Kadawatha',
            'state' => 'Western',
            'postal_code' => '11850',
            'country' => 'Sri Lanka',
            'tax_number' => 'TAX-23456789',
            'registration_number' => 'REG-98765432',
            'payment_terms' => 'Net 45 days',
            'credit_limit' => 300000.00,
            'credit_period' => 45,
            'discount_percentage' => 8.00,
            'bank_name' => 'Hatton National Bank',
            'bank_account_number' => '2345678901',
            'bank_routing_number' => '7083',
            'rating' => 4,
            'notes' => 'Leading supplier of office furniture and equipment. Wide range of products with customization options.',
            'is_active' => true,
            'is_verified' => true,
            'is_preferred' => true,
        ]);

        Supplier::create([
            'name' => 'Lanka Stationery Supplies',
            'code' => 'SUP-STAT001',
            'company_name' => 'Lanka Stationery Supplies (Pvt) Ltd',
            'company_type' => 'corporation',
            'category' => 'material',
            'contact_person' => 'Kumari Jayasinghe',
            'designation' => 'Account Manager',
            'email' => 'orders@lankastationery.lk',
            'phone' => '+94 11 345 6789',
            'mobile' => '+94 76 345 6789',
            'address_line_1' => '789 High Level Road',
            'address_line_2' => 'Nugegoda',
            'city' => 'Colombo',
            'state' => 'Western',
            'postal_code' => '10250',
            'country' => 'Sri Lanka',
            'tax_number' => 'TAX-34567890',
            'registration_number' => 'REG-10987654',
            'payment_terms' => 'Net 15 days',
            'credit_limit' => 150000.00,
            'credit_period' => 15,
            'discount_percentage' => 3.00,
            'bank_name' => 'Bank of Ceylon',
            'bank_account_number' => '3456789012',
            'bank_routing_number' => '7010',
            'rating' => 4,
            'notes' => 'Comprehensive stationery supplier with competitive prices and fast delivery.',
            'is_active' => true,
            'is_verified' => true,
            'is_preferred' => false,
        ]);

        Supplier::create([
            'name' => 'Global Cleaning Services',
            'code' => 'SUP-CLEAN001',
            'company_name' => 'Global Cleaning Services Lanka',
            'company_type' => 'llc',
            'category' => 'service',
            'contact_person' => 'Nimal Fernando',
            'designation' => 'Operations Director',
            'email' => 'info@globalcleaning.lk',
            'phone' => '+94 11 678 9012',
            'mobile' => '+94 77 678 9012',
            'website' => 'https://www.globalcleaning.lk',
            'address_line_1' => '321 Baseline Road',
            'city' => 'Colombo',
            'state' => 'Western',
            'postal_code' => '00900',
            'country' => 'Sri Lanka',
            'tax_number' => 'TAX-45678901',
            'registration_number' => 'REG-21098765',
            'payment_terms' => 'Due on receipt',
            'credit_limit' => 100000.00,
            'credit_period' => 0,
            'discount_percentage' => 0.00,
            'bank_name' => 'Sampath Bank',
            'bank_account_number' => '4567890123',
            'bank_routing_number' => '7302',
            'rating' => 3,
            'notes' => 'Professional cleaning services for offices and commercial buildings. Available 24/7.',
            'is_active' => true,
            'is_verified' => true,
            'is_preferred' => false,
        ]);

        Supplier::create([
            'name' => 'IT Support Hub',
            'code' => 'SUP-ITSUP001',
            'company_name' => 'IT Support Hub Lanka (Pvt) Ltd',
            'company_type' => 'corporation',
            'category' => 'both',
            'contact_person' => 'Anura Wickramasinghe',
            'designation' => 'Technical Director',
            'email' => 'support@itsupporthub.lk',
            'phone' => '+94 11 789 0123',
            'mobile' => '+94 75 789 0123',
            'website' => 'https://www.itsupporthub.lk',
            'address_line_1' => '654 Nawala Road',
            'city' => 'Nugegoda',
            'state' => 'Western',
            'postal_code' => '10250',
            'country' => 'Sri Lanka',
            'tax_number' => 'TAX-56789012',
            'registration_number' => 'REG-32109876',
            'payment_terms' => '2/10 Net 30',
            'credit_limit' => 250000.00,
            'credit_period' => 30,
            'discount_percentage' => 2.00,
            'bank_name' => 'DFCC Bank',
            'bank_account_number' => '5678901234',
            'bank_routing_number' => '7454',
            'rating' => 5,
            'notes' => 'Complete IT solutions provider offering both hardware supplies and technical support services.',
            'is_active' => true,
            'is_verified' => true,
            'is_preferred' => true,
        ]);

        Supplier::create([
            'name' => 'Green Garden Landscaping',
            'code' => 'SUP-GARDEN001',
            'company_name' => 'Green Garden Landscaping Services',
            'company_type' => 'sole_proprietorship',
            'category' => 'service',
            'contact_person' => 'Sunil Bandara',
            'designation' => 'Owner/Operator',
            'email' => 'greengarden@gmail.com',
            'phone' => '+94 33 222 3456',
            'mobile' => '+94 71 222 3456',
            'address_line_1' => '147 Peradeniya Road',
            'city' => 'Kandy',
            'state' => 'Central',
            'postal_code' => '20000',
            'country' => 'Sri Lanka',
            'payment_terms' => 'Advance payment required',
            'credit_limit' => 50000.00,
            'credit_period' => 0,
            'rating' => 3,
            'notes' => 'Small landscaping business providing garden maintenance and design services.',
            'is_active' => true,
            'is_verified' => false,
            'is_preferred' => false,
        ]);
    }
}
