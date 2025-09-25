<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_settings', function (Blueprint $table) {
            $table->boolean('marketing_emails_enabled')->default(true)->after('sms_notifications');
            $table->boolean('security_alerts_enabled')->default(true)->after('marketing_emails_enabled');
            $table->boolean('push_notifications_enabled')->default(true)->after('security_alerts_enabled');
            $table->boolean('auto_save_enabled')->default(true)->after('auto_backup_enabled');
            $table->boolean('backup_enabled')->default(false)->after('auto_save_enabled');
            $table->integer('data_retention_days')->default(30)->after('backup_enabled');
            $table->integer('items_per_page')->default(25)->after('records_per_page');
            $table->boolean('login_notifications_enabled')->default(true)->after('login_alerts_enabled');
            $table->integer('session_timeout')->default(60)->after('session_timeout_minutes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_settings', function (Blueprint $table) {
            $table->dropColumn([
                'marketing_emails_enabled',
                'security_alerts_enabled',
                'push_notifications_enabled',
                'auto_save_enabled',
                'backup_enabled',
                'data_retention_days',
                'items_per_page',
                'login_notifications_enabled',
                'session_timeout'
            ]);
        });
    }
};
