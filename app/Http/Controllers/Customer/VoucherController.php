<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Voucher;

class VoucherController extends Controller
{
    public function voucher(Request $request){
        $coupon = Voucher::where('code',$request->voucher)->first();
        if(! $coupon){
            return redirect()->route('customer.checkout')->withErrors('invalid coupon code .Please try again');
        }
        if(session()->has('cart')){
            $carts = session()->get('cart');
        }
        $total = 0;
        foreach ($carts as $cart){
            $total += $cart['total_price'];
        }
        session()->put('coupon',[
            'name' => $coupon->code,
            'discount' => $coupon->discount($total)
        ]);
        return redirect()->route('customer.checkout')->with('success_message','Coupon has been applied');
    }
}