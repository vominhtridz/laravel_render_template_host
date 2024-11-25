<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
      protected $table = 'promotion';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description', 'promotion_type', 'applicable_to', 'used_count', 'start_date', 'end_date'
,'discount_value','status','category_id','product_id'
];
 public function categories()
{
    return $this->belongsTo(Categories::class,'category_id','id');
}
 public function products()
{
    return $this->belongsTo(Product::class,'product_id','id');
}
}
