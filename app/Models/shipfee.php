<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shipfee extends Model
{
     protected $table = 'shipfee';
    protected $primaryKey = 'id';
    protected $fillable = ['shipping_fee', 'shipfee_type', 'is_free_shipping', 'discount_amount', 'status', 'order_id'
];
 public function order_items()
{
    return $this->belongsTo(order_items::class,'shipfee_id','id');
}

}
