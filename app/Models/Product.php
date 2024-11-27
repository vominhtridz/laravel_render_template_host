<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name','category_id', 'description', 'price', 'quantity', 'image', 'color'];
 public function order_items()
{
    return $this->hasMany(orders::class,'product_id');
}
public function categories(){
        return $this->belongsTo(categories::class, 'category_id');
}
public function reviews(){
        return $this->hasMany(reviews::class, 'product_id','id');
}
   public function promotions()
{
    return $this->hasOne(Promotion::class,'product_id','id');
}
}
