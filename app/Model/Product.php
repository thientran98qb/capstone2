<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tags');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function bills() {
        return $this->belongsToMany(Bill::class,'bill_details','product_id','bill_id')->withPivot('quantity','desc');
    }
}