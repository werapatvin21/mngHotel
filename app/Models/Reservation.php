<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'id',
        'room_id',
        'id_guest',
        'no_guest',
        'check_id',
        'total_night',
        'price',
        'total_price',
        'promotion_code',
        'special_request',
        'remark_by',
        'created_by',
        'hotel_id',
        'id_gent'
        ];
}
