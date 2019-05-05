<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'room_type',
        'price',
        'room_special_price',
        'room_season_price',
        'status',
        'created_by',
        'hotel_id'

    ];
}
