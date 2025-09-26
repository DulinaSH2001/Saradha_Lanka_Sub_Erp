<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_code',
        'company_name',
        'contact_person',
        'email',
        'phone',
        'mobile',
        'address',
        'city',
        'postal_code',
        'country',
        'status',
        'customer_type',
        'credit_limit',
        'payment_terms_days',
        'tax_number',
        'notes',
    ];

    protected $casts = [
        'credit_limit' => 'decimal:2',
    ];

    // Automatically generate customer code when creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (empty($customer->customer_code)) {
                $customer->customer_code = self::generateCustomerCode();
            }
        });
    }

    // Generate unique customer code
    public static function generateCustomerCode()
    {
        do {
            $lastCustomer = self::orderByDesc('id')->first();
            $nextNumber = $lastCustomer ? $lastCustomer->id + 1 : 1;
            $code = 'CUS-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        } while (self::where('customer_code', $code)->exists());

        return $code;
    }

    // Scopes for filtering
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompany($query)
    {
        return $query->where('customer_type', 'company');
    }

    public function scopeIndividual($query)
    {
        return $query->where('customer_type', 'individual');
    }

    // Accessors
    public function getDisplayNameAttribute()
    {
        return $this->company_name ?: $this->contact_person;
    }

    public function getInitialsAttribute()
    {
        $name = $this->display_name;
        $words = explode(' ', $name);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
            if (strlen($initials) >= 2)
                break;
        }

        return $initials ?: 'CU';
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'active' => 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400',
            'inactive' => 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400',
            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400',
        ];

        return $badges[$this->status] ?? $badges['pending'];
    }
}
