<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 regular items
        Item::factory()->count(50)->create();

        // Create 5 items with low stock
        Item::factory()->count(5)->lowStock()->create();

        // Create 3 items that are out of stock
        Item::factory()->count(3)->outOfStock()->create();

        // Create 5 inactive items
        Item::factory()->count(5)->inactive()->create();

        // Create 10 serialized items
        Item::factory()->count(10)->serialized()->create();

        // Create 8 items with expiry tracking
        Item::factory()->count(8)->withExpiryTracking()->create();

        // Create some specific sample items
        Item::create([
            'name' => 'Laptop Computer',
            'code' => 'ITM-LAPTOP001',
            'category' => 'finished_goods',
            'type' => 'product',
            'description' => 'High-performance laptop computer for office use',
            'brand' => 'Dell',
            'model' => 'Inspiron 15',
            'specifications' => 'Intel i5, 8GB RAM, 256GB SSD, Windows 11',
            'unit_of_measure' => 'pcs',
            'purchase_price' => 75000.00,
            'selling_price' => 95000.00,
            'minimum_stock_level' => 5,
            'maximum_stock_level' => 50,
            'reorder_point' => 10,
            'current_stock' => 25,
            'supplier_name' => 'Tech Solutions Ltd.',
            'supplier_contact' => '+94 11 234 5678',
            'supplier_email' => 'orders@techsolutions.lk',
            'barcode' => '1234567890123',
            'sku' => 'SKU-LAPTOP001',
            'weight' => 2.1,
            'dimensions' => '35cm x 24cm x 2cm',
            'is_active' => true,
            'is_serialized' => true,
            'warranty_period' => 24,
            'expiry_tracking' => false,
        ]);

        Item::create([
            'name' => 'Office Chair',
            'code' => 'ITM-CHAIR001',
            'category' => 'finished_goods',
            'type' => 'product',
            'description' => 'Ergonomic office chair with lumbar support',
            'brand' => 'Steelcase',
            'model' => 'Leap V2',
            'specifications' => 'Adjustable height, 360° swivel, fabric upholstery',
            'unit_of_measure' => 'pcs',
            'purchase_price' => 15000.00,
            'selling_price' => 22000.00,
            'minimum_stock_level' => 10,
            'maximum_stock_level' => 100,
            'reorder_point' => 15,
            'current_stock' => 45,
            'supplier_name' => 'Office Furniture Co.',
            'supplier_contact' => '+94 11 567 8901',
            'supplier_email' => 'sales@officefurniture.lk',
            'sku' => 'SKU-CHAIR001',
            'weight' => 18.5,
            'dimensions' => '66cm x 66cm x 120cm',
            'is_active' => true,
            'is_serialized' => false,
            'warranty_period' => 12,
            'expiry_tracking' => false,
        ]);

        Item::create([
            'name' => 'A4 Paper',
            'code' => 'ITM-PAPER001',
            'category' => 'consumables',
            'type' => 'consumable',
            'description' => 'High-quality A4 printing paper',
            'brand' => 'Double A',
            'specifications' => '80gsm, white, 500 sheets per ream',
            'unit_of_measure' => 'pack',
            'purchase_price' => 650.00,
            'selling_price' => 850.00,
            'minimum_stock_level' => 50,
            'maximum_stock_level' => 500,
            'reorder_point' => 75,
            'current_stock' => 200,
            'supplier_name' => 'Paper Supplies Lanka',
            'supplier_contact' => '+94 11 345 6789',
            'supplier_email' => 'orders@papersupplies.lk',
            'barcode' => '9876543210987',
            'sku' => 'SKU-PAPER001',
            'weight' => 2.5,
            'dimensions' => '21cm x 29.7cm x 5cm',
            'is_active' => true,
            'is_serialized' => false,
            'expiry_tracking' => false,
        ]);
    }
}
