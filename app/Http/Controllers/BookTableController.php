<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookTableController extends Controller
{
    protected $table;

    public function __construct(Table $table)
    {
        $this->table = $table;
    }
    public function index(){
        $user = Auth::user();
        $table= $user->tables->first();
        $check = DB::table('user_tables')->where('user_id','=',$user->id)->first() ? true : false;
        return view('customers.orders.booktable',compact('user','check','table'));
    }
    public function filterTable(Request $request){
        $quantity = $request->quantity;
        $table= $this->table->where('quantity',$quantity)->get();

        return response()->json($table);
    }
    public function reservationTable(Request $request){
        $data = $request->all();
        $reservation = [
            'user_id' => Auth::user()->id,
            'table_id' => $data['table'],
            'date' => $data['date'],
            'time'=> $data['time'],
            'phone_number' =>$data['phone_number']
        ];
        DB::table('user_tables')->insert($reservation);
        toast('Reservation placed successfully!','success');
        return redirect()->back();
    }
}