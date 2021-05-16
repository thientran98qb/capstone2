<?php

namespace App\Model;

use App\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use willvincent\Rateable\Rateable;
class Product extends Model
{
    use Rateable;
    use SoftDeletes;
    protected $guarded = [];

    const paginates = 5;
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
        return $this->belongsToMany(Bill::class,'bill_details','product_id','bill_id')->withPivot('quantity','desc','id');
    }
    public function getProductSearch($request)
    {
        $products = new Product();
        if (!empty($request->product_id)) {
            $products = $products->where('products.id', $request->product_id);
        }
        if (!empty($request->name)) {
            $products = $products->where('products.product_name', 'like', '%' . $request->name . '%');
        }
        if (!empty($request->category_id)) {
            $products = $products->where('products.category_id', $request->category_id);
        }
        if (!empty($request->tags)) {
            $products = $products->join('product_tags', 'products.id', 'product_tags.product_id')
                ->join('tags', 'product_tags.tag_id', 'tags.id')
                ->where('tags.tag_name', 'like', '%' . $request->tags . '%');
        }
        $products = $products
            ->groupBy('products.id')
            ->select('products.*')
            ->latest('products.created_at')
            ->paginate(Product::paginates);
        return $products;

    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}