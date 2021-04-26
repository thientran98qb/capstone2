<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Bill;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;

class CheckoutController extends Controller
{
    protected $bill;

    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }
    public function index(){
        $carts =
        session()->has('cart') ?
        session()->get('cart') : '';
        return view('customers.orders.checkout',compact('carts'));
    }

    public function orders(Request $request){
        $user = auth()->user();
        $now = Carbon::now();
        $cart = session()->get('cart');
        $data = [
            'user_id' => $user->id,
            'date_order' => $now->toDateTimeString(),
            'phone_number'=> $request->phone_number,
            'address' => $request->address,
            'total_price'=>$request->total_price,
            'payment' => $request->payment_type,
        ];
        $bill = $this->bill->create($data);
        $quantity = $request->quantity;
        $price = $request->price;
        $product = $request->product_id;
        $sync_data = [];
        for($i = 0; $i < count($product); $i++){
            $sync_data[$product[$i]] = ['quantity' => $quantity[$i],'desc'=>$price[$i]];
        }
        $bill->products()->sync($sync_data);
    }
}