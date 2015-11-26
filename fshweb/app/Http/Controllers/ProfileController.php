<?php

namespace App\Http\Controllers;

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
        return view('profile.index');
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

                $avatarFilename = null;

                if ($request->hasFile('logo_image_path')
                    && $request->file('logo_image_path')->isValid())
                {
                    $avatarFilename = Uuid::uuid4()->toString() . "." . $request->file('logo_image_path')->getClientOriginalExtension();
                    $request->file('logo_image_path')->move(storage_path(config('app.avatar_storage')), $avatarFilename);
                }

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
                $up->logo_image_path = $avatarFilename;
                $up->save();
            }
            else
            {
                $input = $request->only(['firstname', 'lastname', 'bio']);
                $user->userProfile()->create($input);
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
        echo "EDIT PROD";
    }

}
