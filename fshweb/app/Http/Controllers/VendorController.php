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
use Illuminate\Contracts\Routing\ResponseFactory;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UploadHandler;
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
        $vendor = $this->dataAccess->getVendor($id, null, ['country', 'stateProvince']);

        return view('vendor.view')->with('profile', $vendor);
    }

    public function edit()
    {
        $vendor = null;
        if(\Session::has(config('app.session_key_vendor')))
        {
            $vendor = $this->dataAccess->getVendor(\Session::get(config('app.session_key_vendor')), null, 'brands');
        }

        return view('vendor.edit')->with('vendor', $vendor);
    }

    public function update(Request $request)
    {
        if(\Session::has(config('app.session_key_vendor')))
        {
            $user = \Auth::user();
            $data = $request->all();

            $data = array_add($data, 'user_id', $user->id);

            $vendorId = $this->dataAccess->upsertVendor(\Session::get(config('app.session_key_vendor')), $data);

            return redirect('vendor/edit')->with('successMessage', trans('messages.vendor_update_success'));
        }

        return redirect('/');
    }

    public function addBrand(Request $request)
    {
        $uploader = new UploadHandler();
        if ($request->hasFile('brand_image_path'))
        {
            try
            {
                $newFilename = $uploader->uploadVendorAsset($request->file('brand_image_path'));

                $uploader->resizeVendorAsset($newFilename,
                                            config('app.vendor_brand_image_width'),
                                            config('app.vendor_brand_image_height'));

                //            $vendorId = $this->dataAccess->upsertVendor(\Session::get(config('app.session_key_vendor')), $data);


                // Now add brand to db


                return response()->json([
                    'error' => false,
                    'code'  => 200,
                    'filename' => $newFilename
                ], 200);

            }
            catch(Exception $ex)
            {
                return response()->json([
                    'error' => true,
                    'message' => 'Server error while uploading',
                    'code' => 500
                ], 500);
            }
        }

        return response()->json([
            'error' => true,
            'message' => 'Server error while uploading',
            'code' => 500
        ], 500);

    }

    public function deleteBrand(Request $request)
    {

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