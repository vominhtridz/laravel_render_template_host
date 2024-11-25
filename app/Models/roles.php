<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['name'];
     public function permissions()
    {
        return $this->belongsToMany(permissions::class,'permissions_roles');
    }
    public function users(){
        return $this->belongsToMany(User::class,'roles_user','roles_id','user_id');
    }
}
