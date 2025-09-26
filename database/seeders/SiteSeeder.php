<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sites = [
            [
                'name' => 'Main Warehouse Colombo',
                'code' => 'SITE-001',
                'type' => 'warehouse',
                'description' => 'Primary distribution warehouse in Colombo',
                'address' => 'No. 123, Industrial Road, Colombo 15',
                'city' => 'Colombo',
                'state' => 'Western Province',
                'postal_code' => '01500',
                'country' => 'Sri Lanka',
                'phone' => '+94 11 234 5678',
                'email' => 'warehouse.colombo@saradhalanka.lk',
                'manager_name' => 'Priyantha Silva',
                'manager_phone' => '+94 77 123 4567',
                'manager_email' => 'priyantha@saradhalanka.lk',
                'latitude' => 6.9271,
                'longitude' => 79.8612,
                'is_active' => true,
                'storage_capacity' => 50000,
                'operating_hours' => '8:00 AM - 6:00 PM',
            ],
            [
                'name' => 'Kandy Retail Store',
                'code' => 'SITE-002',
                'type' => 'retail_outlet',
                'description' => 'Flagship retail store in Kandy city center',
                'address' => 'No. 456, Peradeniya Road, Kandy',
                'city' => 'Kandy',
                'state' => 'Central Province',
                'postal_code' => '20000',
                'country' => 'Sri Lanka',
                'phone' => '+94 81 234 5678',
                'email' => 'store.kandy@saradhalanka.lk',
                'manager_name' => 'Nishantha Perera',
                'manager_phone' => '+94 77 234 5678',
                'manager_email' => 'nishantha@saradhalanka.lk',
                'latitude' => 7.2906,
                'longitude' => 80.6337,
                'is_active' => true,
                'storage_capacity' => 5000,
                'operating_hours' => '9:00 AM - 9:00 PM',
            ],
            [
                'name' => 'Head Office Colombo',
                'code' => 'SITE-003',
                'type' => 'office',
                'description' => 'Corporate headquarters and administration office',
                'address' => 'No. 789, Galle Road, Colombo 03',
                'city' => 'Colombo',
                'state' => 'Western Province',
                'postal_code' => '00300',
                'country' => 'Sri Lanka',
                'phone' => '+94 11 567 8900',
                'email' => 'headoffice@saradhalanka.lk',
                'manager_name' => 'Sandya Fernando',
                'manager_phone' => '+94 77 345 6789',
                'manager_email' => 'sandya@saradhalanka.lk',
                'latitude' => 6.9147,
                'longitude' => 79.8743,
                'is_active' => true,
                'storage_capacity' => null,
                'operating_hours' => '8:30 AM - 5:30 PM',
            ],
            [
                'name' => 'Galle Distribution Center',
                'code' => 'SITE-004',
                'type' => 'distribution_center',
                'description' => 'Southern province distribution hub',
                'address' => 'No. 321, Matara Road, Galle',
                'city' => 'Galle',
                'state' => 'Southern Province',
                'postal_code' => '80000',
                'country' => 'Sri Lanka',
                'phone' => '+94 91 234 5678',
                'email' => 'distribution.galle@saradhalanka.lk',
                'manager_name' => 'Ruwan Jayawardena',
                'manager_phone' => '+94 77 456 7890',
                'manager_email' => 'ruwan@saradhalanka.lk',
                'latitude' => 6.0329,
                'longitude' => 80.2168,
                'is_active' => true,
                'storage_capacity' => 25000,
                'operating_hours' => '7:00 AM - 5:00 PM',
            ],
            [
                'name' => 'Negombo Retail Outlet',
                'code' => 'SITE-005',
                'type' => 'retail_outlet',
                'description' => 'Coastal retail location serving Negombo area',
                'address' => 'No. 654, Main Street, Negombo',
                'city' => 'Negombo',
                'state' => 'Western Province',
                'postal_code' => '11500',
                'country' => 'Sri Lanka',
                'phone' => '+94 31 234 5678',
                'email' => 'store.negombo@saradhalanka.lk',
                'manager_name' => 'Chamila Dissanayake',
                'manager_phone' => '+94 77 567 8901',
                'manager_email' => 'chamila@saradhalanka.lk',
                'latitude' => 7.2084,
                'longitude' => 79.8380,
                'is_active' => true,
                'storage_capacity' => 3000,
                'operating_hours' => '8:00 AM - 10:00 PM',
            ],
        ];

        foreach ($sites as $siteData) {
            Site::create($siteData);
        }
    }
}
