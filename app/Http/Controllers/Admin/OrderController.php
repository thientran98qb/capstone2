<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Table;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $bill;

    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }

    public function index(){
        $bills = $this->bill->with('user','paymentt')->get();

        return view('admin.orders.index',compact('bills'));
    }

    public function edit($id){
        $arrId = [];
        $bill = $this->bill->with('user')->get()->find($id);
        $detail_bill = $this->bill->with(['products'])->get()->find($id);
        foreach ($detail_bill->products as $key => $value) {
           $arrId[] = $value->pivot->id;
        }
        $order_table = DB::table('order_food_tables')->join('tables','order_food_tables.table_id','=','tables.id')->where('bill_detail_id',$arrId[0])->first();
        // dd($order_table->name);
        return view('admin.orders.detail',compact('bill','detail_bill','order_table'));
    }

    public function updateStatus(Request $request, $id){
        $status = $request->status;
        $bill = $this->bill->find($id)->update([
            'status' => $status
        ]);
        return redirect()->route('admin.order.index');
    }

    public function delete($id)
    {
        try{
            $this->bill->find($id)->delete();
            return response()->json([
                'code' => '200',
                'message' => 'success'
            ],200);
        }catch(Exception $exception){
            Log::error('message'.$exception->getMessage(). 'line' . $exception->getLine());
            return response()->json([
                'code' => '500',
                'message' => 'fail'
            ],500);
        }
    }

    public function reservationTable(){
        $user_tables =DB::table('user_tables')
                    ->join('tables','user_tables.table_id','=','tables.id')
                    ->join('users','user_tables.user_id','=','users.id')
                    ->select('user_tables.*','users.name','users.email', 'tables.name as table_name', 'tables.quantity')
                    ->get();
        return view('admin.orders.reservation_table',compact('user_tables'));
    }

    public function changeStatus(Request $request){

        try{
            $id = $request->id;
            $valueChange = $request->valueChange;
            DB::table('user_tables')->where('id',$id)->update(['status'=>$valueChange]);
            return response()->json([
                'code' => '200',
                'message' => 'success'
            ],200);
        }catch(Exception $exception){
            Log::error('message'.$exception->getMessage(). 'line' . $exception->getLine());
            return response()->json([
                'code' => '500',
                'message' => 'fail'
            ],500);
        }
    }
}