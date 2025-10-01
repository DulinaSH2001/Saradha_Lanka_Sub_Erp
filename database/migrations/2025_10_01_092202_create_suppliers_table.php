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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('company_name')->nullable();
            $table->enum('company_type', ['corporation', 'partnership', 'sole_proprietorship', 'llc', 'other']);
            $table->enum('category', ['material', 'service', 'both']);

            // Contact Information
            $table->string('contact_person')->nullable();
            $table->string('designation')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('website')->nullable();

            // Address Information
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();

            // Business Information
            $table->string('tax_number')->nullable();
            $table->string('registration_number')->nullable();
            $table->text('payment_terms')->nullable();
            $table->decimal('credit_limit', 12, 2)->nullable();
            $table->integer('credit_period')->nullable();
            $table->decimal('discount_percentage', 5, 2)->nullable();

            // Banking Information
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_routing_number')->nullable();

            // Status and Ratings
            $table->tinyInteger('rating')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_preferred')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
