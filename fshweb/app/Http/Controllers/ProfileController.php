<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('profile.profileedit');
    }

    public function profileUpdate(Request $request)
    {


        $user = \App\Models\User::with('userProfile')->find(\Auth::user()->id);

        $userProfile = new \App\Models\UserProfile();

        // Add/Edit metadata
        if(isset($user->userProfile))
        {
            $userProfile = $user->userProfile;
        }

        $userProfile->firstname = $request->input('firstname');
        $userProfile->lastname = $request->input('lastname');
        $userProfile->bio = $request->input('bio');

        // Save / Update user profile
        if(isset($user->userProfile))
        {
            $user->userProfile()->associate($userProfile);
        }
        else
        {
            $user->userProfile()->save($userProfile);
        }


        $user->save();

        echo "pprofile updated";
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
