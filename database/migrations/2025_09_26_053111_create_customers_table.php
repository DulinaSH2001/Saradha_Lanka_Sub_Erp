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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code')->unique(); // CUS-001
            $table->string('company_name');
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('Sri Lanka');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->enum('customer_type', ['individual', 'company'])->default('company');
            $table->decimal('credit_limit', 15, 2)->nullable();
            $table->integer('payment_terms_days')->default(30); // Net 30 days
            $table->string('tax_number')->nullable(); // VAT/TIN number
            $table->text('notes')->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index(['status']);
            $table->index(['customer_type']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
