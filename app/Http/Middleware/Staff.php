<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Staff
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
            return redirect()->route('seller.home');
        }elseif(Auth::user()->user_type == 'staff'){
            return $next($request);
        }else{
            Auth::logout();
            return redirect()->route('frontend.home');
        }
    }
}
