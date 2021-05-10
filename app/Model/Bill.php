<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $guarded = [];

    public function products() {
        return $this->belongsToMany(Product::class,'bill_details','bill_id','product_id')->withPivot('quantity','desc','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function paymentt(){
        return $this->belongsTo(Payment::class,'id','bill_id');
    }
}