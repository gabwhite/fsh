<?php

namespace App\Http\Middleware;

use App\DataAccessLayer;
use Closure;

class PostLogin
{
    protected $dataAccess;

    /**
     * RedirectOnRole constructor.
     */
    public function __construct(DataAccessLayer $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $vendorSessionKey = config('app.session_key_vendor');

        // Clear any existing session vars
        if(\Session::has($vendorSessionKey)) { \Session::forget($vendorSessionKey); }

        $user = $request->user();
        if ($user)
        {
            if($user->hasRole('admin'))
            {
                return redirect('admin');
            }
            else if($user->hasRole('vendor'))
            {
                // Setup vendor id for this user in the session
                $currentUser = \Auth::user();
                $vendors = $this->dataAccess->getVendorsForUser($currentUser->id, ['id']);

                // TODO: We're only supporting one vendor owner per person for now.
                if(count($vendors) > 0) { \Session::put($vendorSessionKey, $vendors[0]->id); }

            }

            return $response;
        }



        //return $next($request);
        return $response;
    }
}
