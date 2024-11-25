<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['name'];
     public function roles()
    {
        return $this->belongsToMany(roles::class, 'permissions_roles','permissions_id','roles_id');
    }
}
