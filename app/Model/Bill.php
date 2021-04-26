<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $guarded = [];

    public function products() {
        return $this->belongsToMany(Product::class,'bill_details','bill_id','product_id')->withPivot('quantity','desc');
    }
}