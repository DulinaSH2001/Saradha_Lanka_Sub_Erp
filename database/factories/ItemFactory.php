<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['raw_material', 'finished_goods', 'semi_finished', 'consumables', 'spare_parts', 'tools'];
        $types = ['product', 'service', 'asset', 'consumable'];
        $brands = ['Samsung', 'Apple', 'Sony', 'LG', 'Philips', 'Panasonic', 'Bosch', 'Generic', null];
        $units = ['pcs', 'kg', 'ltr', 'mtr', 'box', 'pack', 'roll', 'sheet'];

        $purchasePrice = $this->faker->randomFloat(2, 10, 5000);
        $sellingPrice = $purchasePrice * $this->faker->randomFloat(2, 1.1, 2.5);

        $maxStock = $this->faker->numberBetween(100, 1000);
        $minStock = $this->faker->numberBetween(10, 50);
        $currentStock = $this->faker->numberBetween(0, $maxStock);
        $reorderPoint = $this->faker->numberBetween($minStock, $minStock + 20);

        return [
            'name' => $this->faker->words(3, true),
            'code' => 'ITM-' . strtoupper($this->faker->unique()->bothify('???###')),
            'category' => $this->faker->randomElement($categories),
            'type' => $this->faker->randomElement($types),
            'description' => $this->faker->optional(0.7)->sentence(),
            'brand' => $this->faker->randomElement($brands),
            'model' => $this->faker->optional(0.6)->bothify('??###'),
            'specifications' => $this->faker->optional(0.5)->text(200),
            'unit_of_measure' => $this->faker->randomElement($units),
            'purchase_price' => $purchasePrice,
            'selling_price' => $sellingPrice,
            'minimum_stock_level' => $minStock,
            'maximum_stock_level' => $maxStock,
            'reorder_point' => $reorderPoint,
            'current_stock' => $currentStock,
            'supplier_name' => $this->faker->optional(0.8)->company(),
            'supplier_contact' => $this->faker->optional(0.6)->phoneNumber(),
            'supplier_email' => $this->faker->optional(0.6)->companyEmail(),
            'barcode' => $this->faker->optional(0.7)->ean13(),
            'sku' => $this->faker->optional(0.8)->bothify('SKU-??###'),
            'weight' => $this->faker->optional(0.6)->randomFloat(2, 0.1, 50),
            'dimensions' => $this->faker->optional(0.5)->bothify('##cm x ##cm x ##cm'),
            'is_active' => $this->faker->boolean(85),
            'is_serialized' => $this->faker->boolean(20),
            'warranty_period' => $this->faker->optional(0.4)->numberBetween(3, 36),
            'expiry_tracking' => $this->faker->boolean(15),
        ];
    }

    /**
     * Indicate that the item is out of stock.
     */
    public function outOfStock(): static
    {
        return $this->state(fn(array $attributes) => [
            'current_stock' => 0,
        ]);
    }

    /**
     * Indicate that the item has low stock.
     */
    public function lowStock(): static
    {
        return $this->state(function (array $attributes) {
            $minStock = $attributes['minimum_stock_level'] ?? 10;
            return [
                'current_stock' => $this->faker->numberBetween(0, $minStock),
            ];
        });
    }

    /**
     * Indicate that the item is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * Indicate that the item is serialized.
     */
    public function serialized(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_serialized' => true,
        ]);
    }

    /**
     * Indicate that the item has expiry tracking.
     */
    public function withExpiryTracking(): static
    {
        return $this->state(fn(array $attributes) => [
            'expiry_tracking' => true,
        ]);
    }
}
