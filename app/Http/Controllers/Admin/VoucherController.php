<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\User;
use App\Voucher;

class VoucherController extends Controller
{
    protected $voucher;
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function index(){
        $vouchers = $this->voucher->all();
        return view('admin.vouchers.index',compact('vouchers'));
    }

    public function create(){
        return view('admin.vouchers.add');
    }

    public function store(Request $request){

        $data = [
            'type' => $request->type,
            'code' => $request->code,
            'percent_off' =>$request->percent
        ];
        $this->voucher->create($data);
        toast('Your voucher as been created!','success');
        return redirect()->route('admin.voucher.index');
    }
    public function delete($id){
        $this->voucher->findOrFail($id)->delete();
        toast('Your voucher as been deleted!','success');
        return redirect()->route('admin.voucher.index');
    }
}