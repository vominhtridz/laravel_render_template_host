<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class customers extends Model
{
    use HasApiTokens, Notifiable,HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';

    protected $fillable = ['name',
    'email','password','phonenumber','address','zip_code','state','image'];	
public function orders()
{
    return $this->hasMany(orders::class, 'customer_id','customer_id');
}
 public function banks(){
        return $this->hasMany(banks::class, 'customer_id');
    }
}
