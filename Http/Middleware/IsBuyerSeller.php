<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBuyerSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->guard('buyer')->check() || auth()->guard('seller')->check()){
            return $next($request);
        }
        return redirect()->route('form_login');
    }
}
