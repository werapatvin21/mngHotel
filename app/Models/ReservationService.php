<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationService extends Model
{
    protected $fillable = [
        'id_reservations',
        'id_services',
        'hotel_id'
    ];
}
