<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'id',
        'name',
        'code',
        'start_at',
        'end_at',
        'discount',
        'status',
        'unit',
        'created_by',
        'hotel_id'

    ];
}
