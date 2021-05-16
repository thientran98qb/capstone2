<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Product;
use App\Table;
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
        $bill = DB::table('table_products')->join('products','table_products.product_id','=','products.id')->where('table_id',$idTable)->get();
        return response()->json($bill);
    }
}