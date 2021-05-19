<?php

namespace App;

use App\Model\Bill;
use App\Model\Role;
use BeyondCode\Vouchers\Traits\CanRedeemVouchers;
use BeyondCode\Vouchers\Traits\HasVouchers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'user_roles','user_id','role_id');
    }

    public function checkPermissions($permissionCheck){
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            $permission = $role->permissions;
            if($permission->contains('key_code',$permissionCheck)){
                return true;
            }
        }
        return false;
    }
    public function checkRole($roleCheck){
        $roles = auth()->user()->roles;
        if($roles->contains('name',$roleCheck)){
            return true;
        }
        return false;
    }
    public function tables(){
        return $this->BelongsToMany(Table::class,'user_tables','user_id','table_id')->withPivot('phone_number','time','date');
    }

    public function bills(){
        return $this->hasMany(Bill::class,'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}