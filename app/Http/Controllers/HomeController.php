<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Product;
use App\Model\Slider;
use Dotenv\Regex\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use robertogallea\LaravelPython\Services\LaravelPython;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

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
        $categories = Category::with('products')->get();
        $slides = $this->slide->all();
        $products = $this->product->latest()->take(3)->get();
        $product_all = $this->product->all();
        $product_last = $this->product->orderBy('product_name','desc')->take(4)->get();
        return view('home',compact('slides','products','categories','product_all','product_last'));
    }
    public function changeLanguage($language){
       Session::put('lang',$language);
       return redirect()->back();
    }

    public function runPython(){
        $process = new Process('/usr/bin/python3 /home/dinhthien/DEV/LARAVEL/Python/connect_mysql.py');
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput();

        dd($data);
    }
}