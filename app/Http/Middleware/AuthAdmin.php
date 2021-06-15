<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
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
        if (empty(auth()->user()->hak_akses)) {
            return $next($request);
        }
        if(auth()->user()->hak_akses == 1){
            return redirect('/dashboard');
        }
    }
}
