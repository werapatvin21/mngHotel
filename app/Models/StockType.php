<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockType extends Model
{
    protected $fillable = [
        'name',
        'created_by',
        'hotel_id'
    ];
}
