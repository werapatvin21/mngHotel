<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['file','list_name','product_name','number_report','type','status','by','bring','receive','pay','total','created_by'];
}
