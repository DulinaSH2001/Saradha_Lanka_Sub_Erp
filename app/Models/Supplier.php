<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'company_type',
        'category',
        'description',
        'contact_person',
        'designation',
        'email',
        'phone',
        'mobile',
        'fax',
        'website',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'tax_number',
        'registration_number',
        'bank_name',
        'bank_account',
        'bank_branch',
        'payment_terms',
        'credit_limit',
        'credit_days',
        'discount_percentage',
        'is_active',
        'is_preferred',
        'rating',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_preferred' => 'boolean',
        'credit_limit' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'rating' => 'integer',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePreferred($query)
    {
        return $query->where('is_preferred', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByCompanyType($query, $type)
    {
        return $query->where('company_type', $type);
    }

    // Accessors
    public function getFormattedCreditLimitAttribute()
    {
        return 'Rs. ' . number_format((float) $this->credit_limit, 2);
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_active
            ? '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>'
            : '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>';
    }

    public function getPreferredBadgeAttribute()
    {
        return $this->is_preferred
            ? '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Preferred</span>'
            : '';
    }

    public function getRatingStarsAttribute()
    {
        $rating = $this->rating ?? 0;
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $stars .= '<i class="fas fa-star text-yellow-400"></i>';
            } else {
                $stars .= '<i class="far fa-star text-gray-300"></i>';
            }
        }
        return $stars;
    }

    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return substr($initials, 0, 2);
    }

    // Business Logic Methods
    public function canReceiveOrders()
    {
        return $this->is_active;
    }

    public function isWithinCreditLimit($amount)
    {
        return $this->credit_limit === null || $amount <= $this->credit_limit;
    }

    // Static Methods
    public static function getCategories()
    {
        return [
            'raw_materials' => 'Raw Materials',
            'finished_goods' => 'Finished Goods',
            'services' => 'Services',
            'equipment' => 'Equipment & Machinery',
            'consumables' => 'Consumables',
            'packaging' => 'Packaging Materials',
            'utilities' => 'Utilities',
            'logistics' => 'Logistics & Transportation',
            'maintenance' => 'Maintenance & Repair',
            'other' => 'Other',
        ];
    }

    public static function getCompanyTypes()
    {
        return [
            'sole_proprietorship' => 'Sole Proprietorship',
            'partnership' => 'Partnership',
            'private_limited' => 'Private Limited Company',
            'public_limited' => 'Public Limited Company',
            'government' => 'Government Entity',
            'ngo' => 'NGO/Non-Profit',
            'international' => 'International Company',
            'other' => 'Other',
        ];
    }
}
