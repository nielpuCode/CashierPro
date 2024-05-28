<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelInventory;

class ModelPlacedOrder extends Model
{
    use HasFactory;

    protected $table = 'placed_order';

    protected $fillable = [
        'order_id',
        'order_code',
        'item_id',
        'quantity',
        'item_price',
        'time',
    ];

    public function item()
    {
        return $this->belongsTo(ModelInventory::class, 'item_id');
    }
}