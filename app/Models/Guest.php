<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'first_name',
        'las_tname',
        'card_id',
        'passport_id',
        'email',
        'phone',
        'address',
        'file_type',
        'file',
        'note',
        'created_by',
        'hotel_id'
        ];
}
