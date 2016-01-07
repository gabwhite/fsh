<?php
/**
 * Created by PhpStorm.
 * User: byoung
 * Date: 1/7/2016
 * Time: 12:20 PM
 */

namespace App\Http\Controllers;

use App\DataAccessLayer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{

    protected $dataAccess;

    public function __construct(DataAccessLayer $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    public function detail($id)
    {
        $vendor = $this->dataAccess->getVendor($id);

        return view('vendor.view')->with('profile', $vendor);
    }

    public function edit()
    {
        $user = \Auth::user();

        return view('vendor.edit')->with('vendor', $user->vendorOwned);
    }

    public function update(Request $request)
    {
        $user = \Auth::user();

        if(!is_null($user))
        {

            if (!is_null($vp = $user->vendorOwned))
            {
                // Update Vendor
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
                // Vendor doesn't exist, create a row
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

                $user->vendorOwned()->create($vals);
            }

            return redirect('vendor/edit')->with('successMessage', trans('messages.vendor_update_success'));
        }

        return redirect('/');

    }

    public function upsertBrand(Request $request)
    {
        $user = \Auth::user();

        //$this->dataAccess->upsertBrand(1, $request->all());

        echo 'Updated / Added brand';
    }

    protected function brandValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:200',
            'logo_image_path' => 'required|max:200',
            'active' => 'required'
        ]);
    }


}