<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->enum('category', ['raw_material', 'finished_goods', 'semi_finished', 'consumables', 'spare_parts', 'tools']);
            $table->enum('type', ['product', 'service', 'asset', 'consumable']);
            $table->text('description')->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->text('specifications')->nullable();
            $table->string('unit_of_measure')->default('pcs');
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->decimal('selling_price', 12, 2)->nullable();
            $table->integer('minimum_stock_level')->default(0);
            $table->integer('maximum_stock_level')->default(0);
            $table->integer('reorder_point')->default(0);
            $table->integer('current_stock')->default(0);
            $table->string('supplier_name')->nullable();
            $table->string('supplier_contact')->nullable();
            $table->string('supplier_email')->nullable();
            $table->string('barcode')->nullable();
            $table->string('sku')->nullable();
            $table->decimal('weight', 8, 2)->nullable(); // in kg
            $table->string('dimensions')->nullable(); // L x W x H
            $table->boolean('is_active')->default(true);
            $table->boolean('is_serialized')->default(false);
            $table->integer('warranty_period')->nullable(); // in months
            $table->boolean('expiry_tracking')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
