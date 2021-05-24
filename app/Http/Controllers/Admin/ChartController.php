<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Bill;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function getChartByMonth()
    {
        return Bill::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total
        '))
        ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))->orderBy('created_at', 'DESC')->limit(12)->get();
    }

    public function getChartByYear()
    {
        return Bill::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as total'))
        ->groupBy(DB::raw('YEAR(created_at)'))->orderBy('created_at', 'DESC')->limit(5)->get();
    }
    public function index(){
        $payments_month = $this->getChartByMonth();
        $payments_year = $this->getChartByYear();
        return view('admin.chart', compact('payments_month', 'payments_year'));
    }
}