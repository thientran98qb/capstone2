<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Jobs\SendBillMail;
use App\Mail\WelcomeEmail;
use App\Model\Bill;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function GuzzleHttp\Psr7\try_fopen;

class CheckoutController extends Controller
{
    protected $bill;

    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }
    public function index(){
        $user = Auth::user();
        $carts =
        session()->has('cart') ?
        session()->get('cart') : '';

        $discount = session()->get('coupon')['discount'] ?? 0;
        $total = 0;
        if(session()->has('cart')){
            foreach ($carts as $cart){
                $total += $cart['total_price'];
            }
        }
        $newSubTotal = $total - $discount;
        return view('customers.orders.checkout',compact('carts','user','newSubTotal'));
    }

    public function orders(OrderRequest $request){
        $user = auth()->user();
        $now = Carbon::now();
        $cart = session()->get('cart');
        if($request->payment_type == 'vnpay'){
            $data = [
                'user_id' => $user->id,
                'date_order' => $now->toDateTimeString(),
                'fullname'=>$request->fullname,
                'phone_number'=> $request->phone_number,
                'address' => $request->address,
                'total_price'=>$request->total_price,
                'payment' => $request->payment_type,
            ];
            $infoCart = [
                'quantity' => $request->quantity,
                'price' => $request->price,
                'product_id' => $request->product_id
            ];
            session()->put('info_cus',$data);
            session()->put('info_cart',$infoCart);
            session()->put('table_info',[
                'table' => $request->table,
                'date_order_table' =>$request->date_order_table,
                'time_order_table' =>$request->time_order_table,
                'order_type' => $request->selectTable
            ]);
            return view('customers.vnpay.index');
        }else{
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

            if(isset($request->selectTable) && $request->selectTable == 'opt1'){
                $table = $request->table;
                $bill_detail = DB::table('bill_details')->where('bill_id',$bill->id)->get();
                foreach ($bill_detail as $value) {
                    DB::table('order_food_tables')->insert([
                        'bill_detail_id' => $value->id,
                        'table_id' =>$table,
                        'date_order_to' => $request->date_order_table,
                        'time_order'=> $request->time_order_table,
                        'status' => 0
                    ]);
                }

            }
            $billEmail = $this->bill->find($bill->id);
            $name = Auth::user();
            // dispatch(new SendBillMail($billEmail,$name));
            session()->forget('cart');
            session()->forget('coupon');
            return redirect()->back()->with('success',' Bạn đã đặt hàng thành công! Chúng tôi sẽ gửi email xác nhận ngay lập tức');
        }

    }

    public function historyOrder(){
        $bills = $this->bill->where('user_id',Auth::user()->id)->with('user')->get();
        return view('customers.orders.history_order',compact('bills'));
    }

    public function sendMail(){
        $bill = $this->bill->where('user_id',Auth::user()->id)->with('user')->get();
        $name = Auth::user();
        dispatch(new SendBillMail($bill,$name));
    }

}