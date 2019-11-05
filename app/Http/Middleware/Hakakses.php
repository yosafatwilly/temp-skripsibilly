<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Hakakses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permision)
    {
        $permision = explode('|',$permision);
        $role = Auth::user()->role;
        if(check($permision,$role)){
            return $next($request);
        }
        return redirect('/');
    }
}
