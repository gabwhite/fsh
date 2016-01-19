<?php

namespace App\Http\Controllers;

use App\DataAccessLayer;
use App\UploadHandler;
use Illuminate\Http\Request;
use Validator;

use Ramsey\Uuid\Uuid;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    protected $dataAccess;

    /**
     * ProfileController constructor.
     * @param $dataAccess
     */
    public function __construct(DataAccessLayer $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();

        $avatarFilename = null;
        $vendorId = null;
        $vendorOwner = false;
        $bio = null;

        $up = $user->userProfile;
        if (!is_null($up))
        {
            $bio = $up->bio;
            $avatarFilename = $up->avatar_image_path;
        }

        // Get vendor associations

        $vendors = $this->dataAccess->getVendorsForUser($user->id, ['id']);

        // TODO: We're only supporting one vendor owner per person for now.
        if(count($vendors) > 0) { $vendorOwner = true; $vendorId = $vendors[0]->id; }

        return view('profile.index')->with('user', $user)->with(['avatarFilename' => $avatarFilename, 'bio' => $bio, 'vendorId' => $vendorId, 'vendorOwner' => $vendorOwner]);
    }

    public function profileAvatar()
    {
        $user = \Auth::user();
        $up = $user->userProfile();
        if(isset($up))
        {
            $up = \Auth::user()->userProfile;
        }

        return view('profile.editavatar')->with('profile', $up);
    }

    public function profileAvatarUpdate(Request $request)
    {
        $user = \Auth::user();

        if(!is_null($user))
        {
            try
            {
                $action = $request->header('ACTION');
                if(isset($action) && !is_null($action))
                {
                    $up = $user->userProfile;
                    $uploader = new UploadHandler();

                    if($action == 'UPDATE')
                    {
                        if ($request->hasFile('avatar_image_path'))
                        {
                            $avatarFilename = null;

                            if (!is_null($up) && isset($up->avatar_image_path))
                            {
                                $avatarFilename = $up->avatar_image_path;
                            }

                            $newFilename = $uploader->uploadAvatar($request->file('avatar_image_path'), $avatarFilename);

                            if(!is_null($up))
                            {
                                $up->avatar_image_path = $newFilename;
                                $up->save();
                            }
                            else
                            {
                                // UserProfile doesn't exist, create a row
                                $input = ['user_id' => $user->id, 'avatar_image_path' => $newFilename];
                                $user->userProfile()->create($input);
                            }

                            return response()->json([
                                'error' => false,
                                'code'  => 200,
                                'filename' => $newFilename
                            ], 200);
                        }
                    }
                    else if($action == 'DELETE')
                    {
                        // Remove existing avatar
                        if (!is_null($up))
                        {
                            $uploader->removeAvatar($up->avatar_image_path);

                            $up->avatar_image_path = null;
                            $up->save();
                        }

                        return response()->json([
                            'error' => false,
                            'code'  => 200
                        ], 200);
                    }
                    else if($action == 'CROP')
                    {
                        $cropData = explode(';', $request->header('cropdata'));
                        $uploader->cropAvatar($up->avatar_image_path, $cropData);

                        return response()->json([
                            'error' => false,
                            'code'  => 200,
                            'filename' => $up->avatar_image_path
                        ], 200);
                    }
                }
            }
            catch(Exception $ex)
            {
                return response()->json([
                    'error' => true,
                    'message' => 'Server error while uploading/saving/deleting',
                    'code' => 500
                ], 500);
            }


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

        return view('profile.edit')->with('profile', $up);

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
                $up->bio = $request->input('bio');
                $up->save();
            }
            else
            {
                // UserProfile doesn't exist, create a row
                $vals = [
                        'firstname' => $request->input('firstname') ? $request->input('firstname') : null,
                        'lastname' => $request->input('lastname') ? $request->input('lastname') : null,
                        'bio' => $request->input('bio') ? $request->input('bio') : null,
                        ];

                $user->userProfile()->create($vals);
            }

            return redirect('profile/edit')->with('successMessage', trans('messages.profile_update_success'));
        }

        return redirect('/');
    }

}
