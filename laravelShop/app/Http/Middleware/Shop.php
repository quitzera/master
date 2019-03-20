<?php

namespace App\Http\Middleware;

use Closure;

class Shop
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
        $id = session('user_id');
        if(!$id){
            return false;
        }
        return $next($request);
    }
}
