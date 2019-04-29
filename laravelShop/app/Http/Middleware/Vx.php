<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Extend\JSSDK;

class Vx
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
        $jssdk = new JSSDK();
        $signPackage = $jssdk->GetSignPackage();
        $request->merge(['signPackage'=>$signPackage]);
        return $next($request);
    }
}
