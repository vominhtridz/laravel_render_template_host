<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reviews extends Model
{
     protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $fillable = 
    [
        'customer_id','product_id','rating','content','images'
    ];
    public function customers()
{
    return $this->belongsTo(customers::class,'customer_id');
}
}
