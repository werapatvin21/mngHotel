<?php

namespace App;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'staff_name','staff_birth','staff_age',
        'staff_height','staff_weight','staff_role_reception',
        'staff_role_housekeeping','staff_role_food_and_beverage','staff_pos',
        'staff_address','staff_address2','staff_address3',
        'staff_province','staff_phone','staff_status','staff_previous_job',
        'staff_pic','staff_citizen','staff_note','hotel_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function hotel()
    {
        return $this->hasMany(Hotel::Class, 'id', 'hotel_id');
    }
}
