<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function loginAdmin(){
        return view('admin.login.login');
    }

    public function processLogin(AdminLoginRequest $request) {
        // dd($request->all());
        $remember = $request->has('remember_me') ? true : false;
        if(Auth::attempt(
        [
            'email' => $request->email,
            'password' => $request->password,
        ],$remember)){
            return redirect()->to('admin');
        }
        return redirect(route('admin.login'))->with('errorLogin', 'The username or password invalid.');
    }
}