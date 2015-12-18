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
            $userProduct = $this->dataAccess->getUserProduct($id);
            if($userProduct == null) { $userProduct = new \App\Models\UserProduct(); }
        }

        return view('profile.productedit')->with('userproduct', $userProduct);
    }

    public function editProduct(Request $request)
    {
        $user = \Auth::user();
        $productId = $request->input('id');
        $isAdd = false;

        // Now validate / create user product
        $userProductValidator = $this->productValidator($request->all());
        if ($userProductValidator->fails())
        {
            $this->throwValidationException($request, $userProductValidator);
        }

        $userProduct = $this->dataAccess->getUserProductByIdUser($productId, $user->id);
        if(!$userProduct)
        {
            // New user product
            $userProduct = new \App\Models\UserProduct();
            $userProduct->user_id = $user->id;
            //$userProduct->uniquekey = (isset($row[8])) ? $row[8] : $row[11]; // MPC or GTIN

            $isAdd = true;
        }

        $userProduct->name = $request->input('name');
        $userProduct->brand = $request->input('brand');
        $userProduct->pack = $request->input('pack');
        $userProduct->size = $request->input('size');
        $userProduct->uom = $request->input('uom');
        $userProduct->serving_size_uom = $request->input('serving_size_uom');
        $userProduct->mpc = $request->input('mpc');
        $userProduct->broker_contact = $request->input('broker_contact');
        $userProduct->gtin = $request->input('gtin');
        $userProduct->is_halal = ($request->input('is_halal') ? 1 : 0);
        $userProduct->is_organic = ($request->input('is_organic') ? 1 : 0);
        $userProduct->is_kosher = ($request->input('is_kosher') ? 1 : 0);
        $userProduct->calc_size = $request->input('calc_size');
        $userProduct->calculation_size_uom = $request->input('calculation_size_uom');
        $userProduct->calories = $request->input('calories');
        $userProduct->calories_from_fat = $request->input('calories_from_fat');
        $userProduct->protein = $request->input('protein');
        $userProduct->carbs = $request->input('carbs');
        $userProduct->fibre = $request->input('fibre');
        $userProduct->sugar = $request->input('sugar');
        $userProduct->total_fat = $request->input('total_fat');
        $userProduct->saturated_fats = $request->input('saturated_fats');
        $userProduct->sodium = $request->input('sodium');
        $userProduct->product_image = $request->input('product_image');
        $userProduct->description = $request->input('description');
        $userProduct->preparation = $request->input('preparation');
        $userProduct->ingredient_deck = $request->input('ingredient_deck');
        $userProduct->features_benefits = $request->input('features_benefits');
        $userProduct->allergen_disclaimer = $request->input('allergen_disclaimer');
        $userProduct->net_weight = $request->input('net_weight');
        $userProduct->gross_weight = $request->input('gross_weight');
        $userProduct->tare_weight = $request->input('tare_weight');
        $userProduct->serving_size = $request->input('serving_size');
        $userProduct->vendor_logo = $request->input('vendor_logo');
        $userProduct->pos_pdf = $request->input('pos_pdf');
        $userProduct->published = ($request->input('published') ? 1 : 0);

        $userProduct->save();

        return redirect('productdetail/' . $userProduct->id);
    }

    public function profileProducts()
    {
        $user = \Auth::user();

        $products = \App\Models\UserProduct::where('user_id', '=', $user->id)->orderby('name')->paginate(20);

        return view('profile.products')->with('products', $products);
    }

    protected function productValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:500',
            'description' => 'required',
        ]);
    }
}
