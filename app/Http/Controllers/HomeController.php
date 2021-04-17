<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    protected $slide;
    protected $product;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Slider $slide,Product $product)
    {
        // $this->middleware('auth');
        $this->slide = $slide;
        $this->product = $product;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slides = $this->slide->all();
        $products = $this->product->latest()->take(3)->get();
        return view('home',compact('slides','products'));
    }
    public function changeLanguage($language){
       Session::put('lang',$language);
       return redirect()->back();
    }
}