<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(){
        return view('admin.pages.index');
    }
    public function create(){
        return view('admin.pages.add');
    }
}