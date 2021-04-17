<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;

class CartController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    public function addCart(Request $request){
        // session()->flush();
        $idProduct = $request->idProduct;
        $product_item =$this->product->findOrFail($idProduct);
        $cart = session()->get('cart') ;
        if(isset($cart[$idProduct])){
            $cart[$idProduct]['total_price'] = $cart[$idProduct]['price']*($cart[$idProduct]['quantity']+1);
            $cart[$idProduct]['quantity'] =$cart[$idProduct]['quantity']+1;
        }else{
            $cart[$idProduct] = [
                'id' => $product_item->id,
                'product_name' => $product_item->product_name,
                'img' => $product_item->product_image,
                'price' => $product_item->price,
                'quantity' => 1,
                'total_price'=>$product_item->price
            ];

        }
        session()->put('cart',$cart);
        $dataCart = session()->get('cart');
        return response()->json($dataCart);
    }

    public function changeItem(Request $request){
        $id = $request->idItem;
        $num = $request->num;
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            unset($cart[$id]['quantity']);
            $cart[$id]['quantity'] = $num;
            $cart[$id]['total_price'] = $num * $cart[$id]['price'];
            session()->put('cart',$cart);
        }
        $cartNew = session()->get('cart');
        return response()->json($cartNew);
    }
    public function removeItem(Request $request){
        $id = $request->idItem;
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart',$cart);
        }
        $cartNew = session()->get('cart');
        return response()->json($cartNew);
    }
}