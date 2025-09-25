<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSettings extends Model
{
    protected $fillable = [
        'user_id',
        'notifications_enabled',
        'email_notifications',
        'browser_notifications',
        'sms_notifications',
        'marketing_emails_enabled',
        'security_alerts_enabled',
        'auto_serial_number_enabled',
        'auto_backup_enabled',
        'auto_save_enabled',
        'backup_enabled',
        'data_retention_days',
        'date_format',
        'time_format',
        'currency_format',
        'theme',
        'language',
        'timezone',
        'records_per_page',
        'items_per_page',
        'sidebar_collapsed',
        'two_factor_enabled',
        'login_alerts_enabled',
        'login_notifications_enabled',
        'session_timeout_minutes',
        'session_timeout',
        'default_warehouse_id',
        'company_name',
        'signature',
    ];

    protected $casts = [
        'notifications_enabled' => 'boolean',
        'email_notifications' => 'boolean',
        'browser_notifications' => 'boolean',
        'sms_notifications' => 'boolean',
        'marketing_emails_enabled' => 'boolean',
        'security_alerts_enabled' => 'boolean',
        'auto_serial_number_enabled' => 'boolean',
        'auto_backup_enabled' => 'boolean',
        'auto_save_enabled' => 'boolean',
        'backup_enabled' => 'boolean',
        'sidebar_collapsed' => 'boolean',
        'two_factor_enabled' => 'boolean',
        'login_alerts_enabled' => 'boolean',
        'login_notifications_enabled' => 'boolean',
        'records_per_page' => 'integer',
        'items_per_page' => 'integer',
        'session_timeout_minutes' => 'integer',
        'session_timeout' => 'integer',
        'data_retention_days' => 'integer',
    ];

    /**
     * Get the user that owns the settings.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get default settings for a new user.
     */
    public static function getDefaults(): array
    {
        return [
            'notifications_enabled' => true,
            'email_notifications' => true,
            'browser_notifications' => true,
            'sms_notifications' => false,
            'marketing_emails_enabled' => true,
            'security_alerts_enabled' => true,
            'auto_serial_number_enabled' => true,
            'auto_backup_enabled' => false,
            'auto_save_enabled' => true,
            'backup_enabled' => false,
            'data_retention_days' => 30,
            'date_format' => 'Y-m-d',
            'time_format' => 'H:i:s',
            'currency_format' => 'USD',
            'theme' => 'light',
            'language' => 'en',
            'timezone' => 'UTC',
            'records_per_page' => 25,
            'items_per_page' => 25,
            'sidebar_collapsed' => false,
            'two_factor_enabled' => false,
            'login_alerts_enabled' => true,
            'login_notifications_enabled' => true,
            'session_timeout_minutes' => 120,
            'session_timeout' => 60,
        ];
    }
}
