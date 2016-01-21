<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserProfile;
use App\Http\Controllers\Controller;
use App\UploadHandler;

use Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/product/search';


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected function vendorValidator(array $data)
    {
        return Validator::make($data, [
            'intro_text' => 'max:2000',
            'about_text' => 'max:2000',
            //'vendor_id' => 'max:6',
            'company_name' => 'required|max:200',
            'country_id' => 'max:6',
            'state_province_id' => 'max:6',
            'city' => 'max:200',
            'zip_postal' => 'max:50',
            'contact_name' => 'max:200',
            'contact_title' => 'max:200',
            'contact_url' => 'max:200',
            'contact_phone' => 'max:200',
            //'logo_image_path' => 'max:200',
            //'background_image_path' => 'max:200',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data, $role = null)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if(!is_null($role))
        {
            // Add to 'user' role
            $user->attachRole($role);
        }
        else
        {
            // Add to 'user' role
            $user->attachRole(config('app.role_user'));
        }


        return $user;
    }

    protected function createVendor($id, array $data)
    {
        return \App\Models\Vendor::create([
            'user_id' => $id,
            'company_name' => $data['company_name'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'city' => $data['city'],
            'state_province_id' => $data['state_province_id'],
            'country_id' => $data['country_id'],
            'zip_postal' => $data['zip_postal'],
            'contact_name' => $data['contact_name'],
            'contact_title' => $data['contact_title'],
            'contact_phone' => $data['contact_phone'],
            'contact_url' => $data['contact_url'],
            'intro_text' => $data['intro_text'],
            'about_text' => $data['about_text'],
            'logo_image_path' => $data['logo_image_path'],
            'background_image_path' => $data['background_image_path'],
        ]);
    }

    public function getVendorRegister()
    {
        return view('auth.vendorregister');
    }

    public function postVendorRegister(Request $request)
    {

        try
        {
            $validator = $this->validator($request->all());

            if ($validator->fails())
            {
                $this->throwValidationException($request, $validator);
            }


            DB::beginTransaction();

            // Create User first
            $user = $this->create($request->all(), config('app.role_vendor'));


            // Now validate / create vendor profile
            $data = $request->all();


            $vendorValidator = $this->vendorValidator($data);

            if ($vendorValidator->fails())
            {
                $this->throwValidationException($request, $vendorValidator);
            }

            // Attempt to upload the images
            $uploader = new UploadHandler();
            if ($request->hasFile('logo_image_path') && $request->file('logo_image_path')->isValid() && $uploader->isImage($request->file('logo_image_path')))
            {
                $newFilename = $uploader->uploadVendorAsset($request->file('logo_image_path'));
                $data['logo_image_path'] = $newFilename;
            }

            if ($request->hasFile('background_image_path') && $request->file('background_image_path')->isValid() && $uploader->isImage($request->file('background_image_path')))
            {
                $newFilename = $uploader->uploadVendorAsset($request->file('background_image_path'));
                $data['background_image_path'] = $newFilename;
            }

            $vendor = $this->createVendor($user->id, $data);

            DB::commit();

            \Auth::login($user);

        }
        catch(\Exception $ex)
        {

            DB::rollBack();
            throw $ex;

        }

        return redirect($this->redirectPath());

    }
}
