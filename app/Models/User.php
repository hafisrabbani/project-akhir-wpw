<?php

namespace App\Models;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = ['user_id'];
    protected $primaryKey = 'user_id';

    public function roles()
    {
        return $this->BelongsTo(Role::class, 'role_id');
    }
}
