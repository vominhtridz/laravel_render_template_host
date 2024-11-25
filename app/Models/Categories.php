<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'image','slug'];
    public function products(){
        return $this->hasMany(Product::class,'id');
    }
    public function promotions()
{
    return $this->hasOne(Promotion::class, 'category_id','id');
}
}
