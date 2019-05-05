<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesType extends Model
{
    protected $fillable = [
        'name',
        'created_by',
        'hotel_id'
    ];
}
