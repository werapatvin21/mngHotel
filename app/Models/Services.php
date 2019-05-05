<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $fillable = [
        'name',
        'service_id',
        'price',
        'status',
        'created_by',
        'hotel_id'
    ];
}
