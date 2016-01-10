<?php

namespace App\Http\Middleware;

use Closure;

class PostLogout
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
        $vendorSessionKey = config('app.session_key_vendor');

        // Clear session vars
        if(\Session::has($vendorSessionKey))
        {
            \Session::forget($vendorSessionKey);
        }

        return $next($request);
    }
}
