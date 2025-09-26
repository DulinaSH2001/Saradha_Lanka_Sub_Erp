<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
        'description',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'email',
        'manager_name',
        'manager_phone',
        'manager_email',
        'latitude',
        'longitude',
        'is_active',
        'storage_capacity',
        'operating_hours',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Accessors
    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}" .
            ($this->state ? ", {$this->state}" : '') .
            ($this->postal_code ? " {$this->postal_code}" : '') .
            ", {$this->country}";
    }

    public function getTypeDisplayAttribute()
    {
        return match ($this->type) {
            'warehouse' => 'Warehouse',
            'retail_outlet' => 'Retail Outlet',
            'office' => 'Office',
            'distribution_center' => 'Distribution Center',
            default => ucfirst(str_replace('_', ' ', $this->type))
        };
    }

    public function getStatusColorAttribute()
    {
        return $this->is_active ? 'green' : 'red';
    }

    public function getStatusTextAttribute()
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    // Static methods for dropdowns
    public static function getTypes()
    {
        return [
            'warehouse' => 'Warehouse',
            'retail_outlet' => 'Retail Outlet',
            'office' => 'Office',
            'distribution_center' => 'Distribution Center',
        ];
    }
}
