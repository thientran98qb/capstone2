<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Payment;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentVnpayController extends Controller
{
    protected $vnp_HashSecret;

    protected $bill;
    public function __construct(Bill $bill) {
        $this->vnp_HashSecret = 'UQPYOQQKTFSCPMTXNMQTNGIKIKEDCLGX';
        $this->bill = $bill;
    }

    public function create(Request $request)
    {
        $cart = session()->get('cart');
        $sum =0;
        foreach ($cart as $key => $value) {
            $sum+= $value['total_price'];
        }
        $vnp_TxnRef = randString(15); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $sum* 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => env('VNP_TMN_CODE'),
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('customer.vnpay.return'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASH_SECRET')) {
            $vnpSecureHash = hash('sha256', env('VNP_HASH_SECRET') . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
       return redirect($vnp_Url);
    }

    public function return(Request $request){
        if(session()->has('info_cus') && $request->vnp_ResponseCode == '00'){
            DB::beginTransaction();
            try{
                $vnpayData = $request->all();
                $data = session()->get('info_cus');
                $table_info = session()->get('table_info');
                $bill = $this->bill->create($data);

                $infoCart = session()->get('info_cart');
                $sync_data = [];
                $product = $infoCart['product_id'];
                $quantity = $infoCart['quantity'];
                $price = $infoCart['price'];
                for($i = 0; $i < count($product); $i++){
                    $sync_data[$product[$i]] = ['quantity' => $quantity[$i],'desc'=>$price[$i]];
                }
                $bill->products()->sync($sync_data);
                if($table_info['order_type'] == 'opt1'){
                    $table = $table_info['table'];
                    $bill_detail = DB::table('bill_details')->where('bill_id',$bill->id)->get();
                    foreach ($bill_detail as $value) {
                        DB::table('order_food_tables')->insert([
                            'bill_detail_id' => $value->id,
                            'table_id' =>$table,
                            'date_order_to' => $table_info['date_order_table'],
                            'time_order'=> $table_info['time_order_table'],
                            'status' => 0
                        ]);
                    }

                }
                $dataPayment = [
                    'bill_id' => $bill->id,
                    'transaction_code' => $vnpayData['vnp_TxnRef'],
                    'user_id' => Auth::user()->id,
                    'money' => $data['total_price'],
                    'note' => $vnpayData['vnp_OrderInfo'],
                    'vnp_respone_code' => $vnpayData['vnp_ResponseCode'],
                    'code_vnpay'=> $vnpayData['vnp_TransactionNo'],
                    'code_bank'=>$vnpayData['vnp_BankCode'],
                    'time' => date('Y-m-d H:i',strtotime($vnpayData['vnp_PayDate']))
                ];
                Payment::create($dataPayment);
                DB::commit();
                return view('customers.vnpay.vnpay_return',compact('vnpayData'));
            }catch(Exception $exeption){
                $request->session()->flash('error','Have error');
                DB::rollBack();
                return redirect()->to('/');
            }
        }
    }
}