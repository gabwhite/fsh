<?php
/**
 * Created by PhpStorm.
 * User: byoung
 * Date: 1/7/2016
 * Time: 12:22 PM
 */

namespace App\Http\Controllers;

use App\DataAccessLayer;
use App\LookupManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    protected $dataAccess;
    protected $lookupManager;

    public function __construct(DataAccessLayer $dataAccess, LookupManager $lookupManager)
    {
        $this->dataAccess = $dataAccess;
        $this->lookupManager = $lookupManager;
    }

    public function detail($id)
    {
        $product = $this->dataAccess->getProduct($id, 'allergens');

        return view('product.detail')->with('product', $product);
    }

    public function search()
    {
        return view('product.search');
    }

    public function showProduct($id = null)
    {
        $user = \Auth::user();

        // Only admins or product owner can edit product
        $canEdit = false;
        if($user->hasRole(config('app.role_admin_name')) || $this->dataAccess->isVendorOwner($user->id, $id))
        {
            $canEdit = true;
        }

        $product = new \App\Models\Product();
        if($id != null && $canEdit)
        {
            $product = $this->dataAccess->getProduct($id, 'allergens');
            if($product == null) { $product = new \App\Models\Product(); }
        }

        $allergens = $this->lookupManager->getProductAllergens();

        return view('product.edit')->with(['product' => $product, 'allergens' => $allergens]);
    }

    public function editProduct(Request $request)
    {
        $user = \Auth::user();
        $productId = $request->input('id');

        // Now validate user product
        $productValidator = $this->productValidator($request->all());
        if ($productValidator->fails())
        {
            $this->throwValidationException($request, $productValidator);
        }

        $productId = $this->dataAccess->upsertProduct($productId, $user->id, $request->all());

        return redirect('product/detail/' . $productId)->with('successMessage', trans('messages.product_update_success'));;
    }

    public function vendorProducts()
    {
        $user = \Auth::user();

        $products = $this->dataAccess->getProductsByVendor($user->id, ['id', 'name'], true, 20);

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