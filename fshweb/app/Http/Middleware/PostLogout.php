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
        // Clear session vars
        if(\Session::has('vendor_id'))
        {
            \Session::forget('vendor_id');
        }

        return $next($request);
    }
}
