<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'grn_id',
        'item_id',
        'item_code',
        'description',
        'qty',
        'rate',
        'amount',
        'disc_percent',
        'disc_amount',
        'total'
    ];

    protected $casts = [
        'qty' => 'decimal:3',
        'rate' => 'decimal:2',
        'amount' => 'decimal:2',
        'disc_percent' => 'decimal:2',
        'disc_amount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function grn()
    {
        return $this->belongsTo(Grn::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
