<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
     protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $fillable = 
    [
        'web_name','email','logo','infor_bank','address'
    ];
 
}
