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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Notification settings
            $table->boolean('notifications_enabled')->default(true);
            $table->boolean('email_notifications')->default(true);
            $table->boolean('browser_notifications')->default(true);
            $table->boolean('sms_notifications')->default(false);
            $table->boolean('marketing_emails_enabled')->default(true);
            $table->boolean('security_alerts_enabled')->default(true);
            $table->boolean('push_notifications_enabled')->default(true);

            // System preferences
            $table->boolean('auto_serial_number_enabled')->default(true);
            $table->boolean('auto_backup_enabled')->default(false);
            $table->boolean('auto_save_enabled')->default(true);
            $table->boolean('backup_enabled')->default(false);
            $table->integer('data_retention_days')->default(30);

            // UI preferences
            $table->string('date_format')->default('Y-m-d');
            $table->string('time_format')->default('H:i:s');
            $table->string('currency_format')->default('USD');
            $table->string('theme')->default('light');
            $table->string('language')->default('en');
            $table->string('timezone')->default('UTC');
            $table->integer('records_per_page')->default(25);
            $table->integer('items_per_page')->default(25);
            $table->boolean('sidebar_collapsed')->default(false);

            // Security settings
            $table->boolean('two_factor_enabled')->default(false);
            $table->boolean('login_alerts_enabled')->default(true);
            $table->boolean('login_notifications_enabled')->default(true);
            $table->integer('session_timeout_minutes')->default(120);
            $table->integer('session_timeout')->default(60);

            // Additional settings
            $table->string('default_warehouse_id')->nullable();
            $table->string('company_name')->nullable();
            $table->text('signature')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
