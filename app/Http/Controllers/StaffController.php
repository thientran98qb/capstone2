<?php

namespace App\Http\Controllers;

use App\Model\Bill;
use App\Model\Category;
use App\Model\Product;
use App\Table;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    protected $category;
    protected $food;
    protected $table;
    public function __construct(
        Category $category,
        Product $food,
        Table $table
    ){
        $this->category = $category;
        $this->food = $food;
        $this->table = $table;
    }
    public function index(){
        $categories = $this->category->all();
        $tables =$this->table->all();
        return view('customers.staff.index',compact('categories','tables'));
    }

    public function filterFood(Request $request){
        $idCategory = $request->id;
        $foods = $this->food->where('category_id',$idCategory)->get();
        return response()->json(['foods'=>$foods]);
    }

    public function addMenu(Request $request){
        $tableId = $request->tableId;
        $foodId =$request->foodID;
        $food = $this->food->find($foodId);
        $quantity =$request->quantity;
        if(DB::table('table_products')->where('product_id',$foodId)->count() > 0  ){
            $quantityOld =  DB::table('table_products')->where('product_id',$foodId)->first();
            DB::table('table_products')->where('product_id',$foodId)->update([
                'amount' => $quantityOld->amount+$quantity,
                'total' =>  $quantityOld->total +($food->price * $quantity),
            ]);
        }else{
            DB::table('table_products')->insert([
                'product_id' => $foodId,
                'table_id' => $tableId,
                'amount' => $quantity,
                'total' => $food->price * $quantity
            ]);
        }
        return response()->json(['food'=>$food,'quantity'=>$quantity]);
    }
    public function fillOrder(Request $request){
        $idTable = $request->idTable;
        session()->put('table_id',$idTable);
        $bill = DB::table('table_products')->join('products','table_products.product_id','=','products.id')->where('table_id',$idTable)->get();
        return response()->json($bill);
    }

    public function bill(){
        $table_id = session()->has('table_id') ? session()->get('table_id') : '';
        $bills = Table::with('products')->find($table_id);

        return view('customers.staff.bill',compact('bills'));
    }

    public function pdf(){
        $table_id = session()->has('table_id') ? session()->get('table_id') : '';
        $bills = Table::with('products')->find($table_id);
        $data['title'] = 'Bill List';
        $data['bills'] =  $bills;

        $pdf = PDF::loadView('customers.staff.pdf',$data)->setPaper('a4','portrait');

        return $pdf->stream('bills.pdf');
    }

    public function saveBill(Request $request){
        $total_bill = $request->total_bill;
        $table_id = session()->has('table_id') ? session()->get('table_id') : '';
        $dt = Carbon::now();
        Bill::create([
            'user_id' => Auth::user()->id,
            'date_order' => $dt->toDateTimeString(),
            'phone_number' => '0815858468',
            'address' => 'POWA Restaurant',
            'total_price' => $total_bill,
            'payment' => 'In restaurant',
        ]);
        DB::table('table_products')->where('table_id',$table_id)->delete();
        session()->forget('table_id');
        return redirect()->route('staff');
    }
}