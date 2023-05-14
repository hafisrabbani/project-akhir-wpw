<?php

namespace App\Models;

class Role extends Model
{
    protected $table = 'roles';
    protected $guarded = ['role_id'];
    protected $primaryKey = 'role_id';
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
