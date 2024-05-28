<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCart extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    protected $fillable = [
        'item_id',
        'quantity',
        'price',
    ];

    protected $primaryKey = 'id';

    public function item()
    {
        return $this->belongsTo(ModelInventory::class, 'item_id');
    }
}