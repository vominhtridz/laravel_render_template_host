<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders';
    public $timestamps = false;
     protected $primaryKey = 'order_id';
    protected $fillable = 
    [
        'customer_id','delivered_date','shipped_date','payment_date','order_date','payment_status','shipping_address','shipping_method','total_amount', 'product_id', 'quantity','notes', 'total_price', 'payment_method', 'order_status',
    ];
    public function customers()
{
    return $this->belongsTo(customers::class,'customer_id','customer_id');
}

public function order_items()
{
    return $this->hasMany(order_items::class, 'order_id','order_id');
}


}
