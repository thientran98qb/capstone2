<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded =[];
    protected $table = 'product_images';
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}