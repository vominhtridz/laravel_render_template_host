<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class address extends Model
{
     protected $table = 'address';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'phonenumber',
        'detail_address',
        'city_address',
        'postal_code',
        'customer_id',
        'default'
    ];
    public function customers(){
        return $this->belongsTo(customers::class, 'customer_id');
    }
   
}
