<?php

// ModelOrderHistory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelOrderHistory extends Model
{
    use HasFactory;

    protected $table = 'order_history';

    protected $fillable = [
        'order_code',
        'time',
    ];
}