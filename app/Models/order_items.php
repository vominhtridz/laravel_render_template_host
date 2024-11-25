<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
     protected $table = 'order_items';
    protected $fillable = ['order_id','product_id','quantity','unit_price','total_price','address_id','shipfee_id'];
   
 public function products()
{
    return $this->belongsTo(Product::class,'product_id');
}
public function address()
{
    return $this->belongsTo(address::class, 'address_id','id');
}
public function shipfee()
{
    return $this->hasOne(shipfee::class,'shipfee_id','id');
}


}
