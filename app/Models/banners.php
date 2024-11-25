<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banners extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = [
        'name',
        'image_url',
        'link_url',
        'start_date',
        'end_date',
        'status',
        'description',
        'created_by',
        'updated_by',
    ];
    
}
