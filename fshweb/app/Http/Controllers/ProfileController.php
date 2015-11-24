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
        $up = \Auth::user()->userProfile();
        if(isset($up))
        {
            $up = \Auth::user()->userProfile;
        }

        return view('profile.profileedit')->with('profile', $up);
    }

    public function profileUpdate(Request $request)
    {
        $user = \Auth::user();

        if(!is_null($user))
        {


            if (!is_null($up = $user->userProfile))
            {
                $up->firstname = $request->input('firstname');
                $up->lastname = $request->input('lastname');
                $up->bio = $request->input('bio');
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
