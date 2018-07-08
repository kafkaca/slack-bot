<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];
    protected $casts = [
        'permissions' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }

    public function hasAccess(array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }

        }
        return false;
    }

    private function hasPermission(string $permission): bool
    {
        return $this->permissions[$permission] ?? false;
    }
}

//SOURCES

/*
https: //laravel-news.com/authorization-gates
https: //thewebtier.com/laravel/understanding-roles-permissions-laravel/
https: //www.5balloons.info/user-role-based-authentication-and-access-control-in-laravel/


*/

