<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBuyer
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
        if(auth()->guard('buyer')->check()){
            return $next($request);
        }
        return redirect()->route('form_login');
    }
}
