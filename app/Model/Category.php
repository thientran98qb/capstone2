<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'parent_id',
        'img_category'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}