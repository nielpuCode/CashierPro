<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelInventory extends Model
{
    use HasFactory;

    protected $table = 'inventory_items';

    protected $fillable = [
        'name',
        'price',
        'barcode',
        'quantity',
        'image',
    ];

    protected $primaryKey = 'id';
}
