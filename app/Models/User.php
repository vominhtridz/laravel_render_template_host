<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'role',
        'last_login_at',
        'image',
        'phone_number',
        'address',
        'is_verified',
        'birthday',
        'gender',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function roles (){
        return $this->belongsToMany(roles::class,'roles_user', 'user_id', 'roles_id');
    }
    public function hasRole($role)
{
    return $this->roles()->where('name', $role)->exists();
}
    public function HasPermissions($permission){
        foreach ($this->roles as $role) {
            if ($role->permissions()->where('name', $permission)->exists()) {
            return true;
        }
        }
    return false;
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
