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
        $avatarSessionKey = config('app.session_key_avatar');

        // Clear any existing session vars
        if($request->session()->has($vendorSessionKey)) { $request->session()->forget($vendorSessionKey); }
        if($request->session()->has($avatarSessionKey)) { $request->session()->forget($avatarSessionKey); }

        $user = $request->user();
        if ($user)
        {
            // Set avatar path for user
            if($user->userProfile
                && !is_null($user->userProfile->avatar_image_path)
                    && $user->avatar_image_path !== '')
            {
                $request->session()->put($avatarSessionKey, $user->userProfile->avatar_image_path);
            }


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
                if(count($vendors) > 0) { $request->session()->put($vendorSessionKey, $vendors[0]->id); }

            }

            return $response;
        }



        //return $next($request);
        return $response;
    }
}
