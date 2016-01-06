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
            $avatarFilename = $up->avatar_image_path;
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
            }
            else if($request->input('current_avatar_image_path') == "0")
            {
                // Remove existing avatar
                if (!is_null($up))
                {
                    $uploader->removeAvatar($up->avatar_image_path);

                    $up->avatar_image_path = null;
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

        return view('profile.profileedit')->with('profile', $up);

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

            return redirect('profile/edit');
        }

        return redirect('/');
    }

    public function vendorEdit()
    {
        $user = \Auth::user();
        $vp = $user->vendorProfile();
        if(isset($vp))
        {
            $vp = \Auth::user()->vendorProfile;
        }

        if($user->hasRole(['vendor']))
        {
            return view('profile.profileeditvendor')->with('profile', $vp);
        }

        return redirect('/');

    }

    public function vendorUpdate(Request $request)
    {
        $user = \Auth::user();

        if(!is_null($user))
        {

            if (!is_null($vp = $user->vendorProfile))
            {
                // Update VendorProfile
                $vp->company_name = $request->input('company_name') ? $request->input('company_name') : null;
                $vp->country = $request->input('country') ? $request->input('country') : null;
                $vp->state_province = $request->input('state_province') ? $request->input('state_province') : null;
                $vp->address1 = $request->input('address1') ? $request->input('address1') : null;
                $vp->address2 = $request->input('address2') ? $request->input('address2') : null;
                $vp->city = $request->input('city') ? $request->input('city') : null;
                $vp->zip_postal = $request->input('zip_postal') ? $request->input('zip_postal') : null;
                $vp->contact_name = $request->input('contact_name') ? $request->input('contact_name') : null;
                $vp->contact_title = $request->input('contact_title') ? $request->input('contact_title') : null;
                $vp->contact_phone = $request->input('contact_phone') ? $request->input('contact_phone') : null;
                $vp->contact_url = $request->input('contact_url') ? $request->input('contact_url') : null;
                $vp->intro_text = $request->input('intro_text') ? $request->input('intro_text') : null;
                $vp->about_text = $request->input('about_text') ? $request->input('about_text') : null;

                $vp->save();
            }
            else
            {
                // VendorProfile doesn't exist, create a row
                $vals = [
                    'company_name' => $request->input('company_name') ? $request->input('company_name') : null,
                    'country' => $request->input('country') ? $request->input('country') : null,
                    'state_province' => $request->input('state_province') ? $request->input('state_province') : null,
                    'address1' => $request->input('address1') ? $request->input('address1') : null,
                    'address2' => $request->input('address2') ? $request->input('address2') : null,
                    'city' => $request->input('city') ? $request->input('city') : null,
                    'zip_postal' => $request->input('zip_postal') ? $request->input('zip_postal') : null,
                    'contact_name' => $request->input('contact_name') ? $request->input('contact_name') : null,
                    'contact_title' => $request->input('contact_title') ? $request->input('contact_title') : null,
                    'contact_phone' => $request->input('contact_phone') ? $request->input('contact_phone') : null,
                    'contact_url' => $request->input('contact_url') ? $request->input('contact_url') : null,
                    'intro_text' => $request->input('intro_text') ? $request->input('intro_text') : null,
                    'about_text' => $request->input('about_text') ? $request->input('about_text') : null,
                ];

                $user->vendorProfile()->create($vals);
            }

            return redirect('profile/editvendor');
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
