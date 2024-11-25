<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $fillable = [
        'quantity',
        'price',
        'discount',
        'customer_id',
        'product_id',
        'total_price',
        'session_id'
    ];
    public function customers(){
        return $this->belongsTo(customers::class, 'customer_id');
    }
    public function products(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}
