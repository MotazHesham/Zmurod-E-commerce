<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Seller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->user_type == 'customer'){
            return redirect()->route('customer.home');
        }elseif(Auth::user()->user_type == 'seller'){
            return $next($request);
        }elseif(Auth::user()->user_type == 'staff'){
            return redirect()->route('admin.home');
        }else{
            Auth::logout();
            return redirect()->route('frontend.home');
        }
    }
}
