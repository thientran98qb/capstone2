<?php

namespace App;

use App\Model\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Table extends Model
{
    protected $guarded = [];

    public function users(){
        return $this->BelongsToMany(User::class,'user_tables','table_id','user_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'table_products','table_id','product_id')->withPivot('amount','total');
    }
}