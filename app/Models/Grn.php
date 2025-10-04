<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grn extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'site_id',
        'grn_no',
        'date',
        'reference_no',
        'grn_date',
        'due_date',
        'subtotal',
        'discount_percent',
        'discount_amount',
        'vat_percent',
        'vat_amount',
        'total',
        'account_id',
        'memo'
    ];

    protected $casts = [
        'date' => 'date',
        'grn_date' => 'date',
        'due_date' => 'date',
        'subtotal' => 'decimal:2',
        'discount_percent' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'vat_percent' => 'decimal:2',
        'vat_amount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function items()
    {
        return $this->hasMany(GrnItem::class);
    }
}
