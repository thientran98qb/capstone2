<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->belongsToMany(Product::class,'product_tags');
    }
}