<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserProfile;
use App\Http\Controllers\Controller;

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

    protected $redirectPath = '/';


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
            'bio' => 'max:2000',
            //'vendor_id' => 'max:6',
            'company' => 'required|max:200',
            'country' => 'required|max:6',
            'state_province' => 'required|max:6',
            'city' => 'required|max:200',
            'zip_postal' => 'required|max:50',
            'contact_name' => 'required|max:200',
            'contact_phone' => 'max:200',
            'logo_image_path' => 'max:200',
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

    protected function createVendorUserProfile($id, array $data)
    {
        return UserProfile::create([
            'user_id' => $id,
            'bio' => $data['bio'],
            'company' => $data['company'],
            'country' => $data['country'],
            'state_province' => $data['state_province'],
            'city' => $data['city'],
            'zip_postal' => $data['zip_postal'],
            'contact_name' => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'logo_image_path' => $data['logo_image_path'],
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


            // Now validate / create user profile
            $vendorUserProfileValidator = $this->vendorValidator($request->all());

            if ($vendorUserProfileValidator->fails()) {
                $this->throwValidationException(
                    $request, $vendorUserProfileValidator
                );
            }

            $this->createVendorUserProfile($user->id, $request->all());

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
