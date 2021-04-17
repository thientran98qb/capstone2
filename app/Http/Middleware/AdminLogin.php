<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check())
        {
            $user = Auth::user();
            $roles = $user->roles;
            foreach ($roles as $role) {
               if($role->name != 'guest'){
                return $next($request);
               }else
               {
                   Auth::logout();
                   return redirect()->route('admin.login')->with('errorLogin', 'Not permission to login in the system');
                }
               }
        } else
            return redirect()->route('admin.login');
    }
}