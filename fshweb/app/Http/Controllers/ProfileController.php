<?php

namespace App\Http\Controllers;

use App\UploadHandler;
use Illuminate\Http\Request;

use Ramsey\Uuid\Uuid;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();

        $avatarFilename = null;

        $up = $user->userProfile;
        if (!is_null($up))
        {
            $avatarFilename = $up->logo_image_path;
        }

        return view('profile.index')->with('user', $user)->with('avatarFilename', $avatarFilename);
    }

    public function profileAvatar()
    {
        $user = \Auth::user();
        $up = $user->userProfile();
        if(isset($up))
        {
            $up = \Auth::user()->userProfile;
        }

        return view('profile.avataredit')->with('profile', $up);
    }

    public function profileAvatarUpdate(Request $request)
    {
        $user = \Auth::user();

        if(!is_null($user))
        {
            $uploader = new UploadHandler();
            $up = $user->userProfile;

            if ($request->hasFile('logo_image_path'))
            {
                $avatarFilename = null;

                if (!is_null($up) && isset($up->logo_image_path))
                {
                    $avatarFilename = $up->logo_image_path;
                }

                $newFilename = $uploader->uploadAvatar($request->file('logo_image_path'), $avatarFilename);

                if(!is_null($up))
                {
                    $up->logo_image_path = $newFilename;
                    $up->save();
                }
                else
                {
                    // UserProfile doesn't exist, create a row
                    $input = ['user_id' => $user->id, 'logo_image_path' => $newFilename];
                    $user->userProfile()->create($input);
                }
            }
            else if($request->input('current_logo_image_path') == "0")
            {
                // Remove existing avatar
                if (!is_null($up))
                {
                    $uploader->removeAvatar($up->logo_image_path);

                    $up->logo_image_path = null;
                    $up->save();
                }
            }

            return redirect('profile/');
        }

        return redirect('/');
    }


    public function profileEdit()
    {
        $user = \Auth::user();
        $up = $user->userProfile();
        if(isset($up))
        {
            $up = \Auth::user()->userProfile;
        }

        if($user->hasRole(['admin', 'user']))
        {
            return view('profile.profileedit')->with('profile', $up);
        }
        else
        {
            return view('profile.profileeditvendor')->with('profile', $up);
        }
    }

    public function profileUpdate(Request $request)
    {
        $user = \Auth::user();

        if(!is_null($user))
        {

            if (!is_null($up = $user->userProfile))
            {
                // Update UserProfile
                $up->firstname = $request->input('firstname') ? $request->input('firstname') : null ;
                $up->lastname = $request->input('lastname') ? $request->input('lastname') : null;
                $up->company = $request->input('company') ? $request->input('company') : null;
                $up->country = $request->input('country') ? $request->input('country') : null;
                $up->state_province = $request->input('state_province') ? $request->input('state_province') : null;
                $up->city = $request->input('city') ? $request->input('city') : null;
                $up->zip_postal = $request->input('zip_postal') ? $request->input('zip_postal') : null;
                $up->contact_name = $request->input('contact_name') ? $request->input('contact_name') : null;
                $up->contact_phone = $request->input('contact_phone') ? $request->input('contact_phone') : null;
                $up->bio = $request->input('bio');
                $up->save();
            }
            else
            {
                // UserProfile doesn't exist, create a row
                $vals = [
                        'firstname' => $request->input('firstname') ? $request->input('firstname') : null,
                        'lastname' => $request->input('lastname') ? $request->input('lastname') : null,
                        'company' => $request->input('company') ? $request->input('company') : null,
                        'country' => $request->input('country') ? $request->input('country') : null,
                        'state_province' => $request->input('state_province') ? $request->input('state_province') : null,
                        'city' => $request->input('city') ? $request->input('city') : null,
                        'zip_postal' => $request->input('zip_postal') ? $request->input('zip_postal') : null,
                        'contact_name' => $request->input('contact_name') ? $request->input('contact_name') : null,
                        'contact_phone' => $request->input('contact_phone') ? $request->input('contact_phone') : null,
                        'bio' => $request->input('bio') ? $request->input('bio') : null,
                        ];

                //$input = $request->only(['firstname', 'lastname', 'bio']);
                $user->userProfile()->create($vals);
            }

            return redirect('profile/edit');
        }

        return redirect('/');
    }

    public function showProduct($id = null)
    {
        $userProduct = new \App\Models\UserProduct();
        if($id != null)
        {
            $userProduct = \App\Models\UserProduct::where('id', '=', $id)->first();
            if($userProduct == null) { $userProduct = new \App\Models\UserProduct(); }
        }

        return view('profile.productedit')->with('userproduct', $userProduct);
    }

    public function editProduct(Request $request)
    {
        echo "TODO EDIT PROD";
    }

}
