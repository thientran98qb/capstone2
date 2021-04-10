<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class,'user_roles','role_id','user_id');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_roles','role_id','permission_id');
    }
}