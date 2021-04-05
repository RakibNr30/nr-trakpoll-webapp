<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
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
        if(auth()->user()->role == 'sysadmin'){
            return $next($request);
        }
        elseif(auth()->user()->role == 'sysowner'){
            return $next($request);
        }
        elseif(auth()->user()->role == 'surveyadmin'){
            return $next($request);
        }
        else{
            return redirect()->with('error', 'You Can not Access Admin area');
        }
    }
}
