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
        $avatarSessionKey = config('app.session_key_avatar');

        // Clear session vars
        if($request->session()->has($vendorSessionKey))
        {
            $request->session()->forget($vendorSessionKey);
        }

        if($request->session()->has($avatarSessionKey))
        {
            $request->session()->forget($avatarSessionKey);
        }

        return $next($request);
    }
}
