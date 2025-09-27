<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'category',
        'type',
        'description',
        'brand',
        'model',
        'specifications',
        'unit_of_measure',
        'purchase_price',
        'selling_price',
        'minimum_stock_level',
        'maximum_stock_level',
        'reorder_point',
        'current_stock',
        'supplier_name',
        'supplier_contact',
        'supplier_email',
        'barcode',
        'sku',
        'weight',
        'dimensions',
        'is_active',
        'is_serialized',
        'warranty_period',
        'expiry_tracking',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_serialized' => 'boolean',
        'expiry_tracking' => 'boolean',
        'purchase_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'minimum_stock_level' => 'integer',
        'maximum_stock_level' => 'integer',
        'reorder_point' => 'integer',
        'warranty_period' => 'integer',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('current_stock', '<=', 'minimum_stock_level');
    }

    // Accessors
    public function getFormattedPurchasePriceAttribute()
    {
        return 'Rs. ' . number_format((float) $this->purchase_price, 2);
    }

    public function getFormattedSellingPriceAttribute()
    {
        return 'Rs. ' . number_format((float) $this->selling_price, 2);
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_active
            ? '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>'
            : '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>';
    }

    // Business Logic Methods
    public function isLowStock()
    {
        return $this->current_stock <= $this->minimum_stock_level;
    }

    public function needsReorder()
    {
        return $this->current_stock <= $this->reorder_point;
    }
}
