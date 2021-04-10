<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];
    public function getPermission(){
        return $this->hasMany(Permission::class,'parent_id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class,'permission_roles','permission_id','role_id');
    }
}
