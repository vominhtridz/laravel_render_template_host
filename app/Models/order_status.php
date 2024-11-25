<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_status extends Model
{
     protected $table = 'order_status';
    protected $fillable = 
    [
       'order_id','status'
    ];

}
