<?php
/**
 * Created by PhpStorm.
 * User: byoung
 * Date: 1/7/2016
 * Time: 12:22 PM
 */

namespace App\Http\Controllers;

use App\CacheManager;
use App\DataAccessLayer;
use App\LookupManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    protected $dataAccess;
    protected $lookupManager;
    protected $cacheManager;

    public function __construct(DataAccessLayer $dataAccess, LookupManager $lookupManager, CacheManager $cacheManager)
    {
        $this->dataAccess = $dataAccess;
        $this->lookupManager = $lookupManager;
        $this->cacheManager = $cacheManager;
    }

    public function detail($id)
    {
        $cacheKey = 'product-'.$id;
        $product = $this->cacheManager->getItem(env('CACHE_DRIVER'), $cacheKey);
        if(is_null($product) || !isset($product))
        {
            $product = $this->dataAccess->getProduct($id, ['allergens']);
            $this->cacheManager->setItem(env('CACHE_DRIVER'), $cacheKey, $product, config('app.cache_expiry_time_products'));
        }

        $canEdit = false;

        if(\Auth::check())
        {
            $user = \Auth::user();

            if($user->hasRole(config('app.role_admin_name'))
                || \Session::get(config('app.session_key_vendor')) == $product->vendor_id)
            {
                $canEdit = true;
            }
        }

        return view('product.detail')->with(['product' => $product, 'canEdit' => $canEdit]);
    }

    public function search()
    {
        return view('product.search');
    }

    public function doSearch(Request $request)
    {
        $results = $this->dataAccess->getProductsByFullText($request->input('searchquery'),
                                    ['id', 'name', 'brand', 'pack', 'uom', 'mpc', 'calc_size', 'description'],
                                    'name',
                                    true,
                                    config('app.search_default_page_size'));

        return view('product.search')->with(['searchresults' => $results, 'searchquery' => $request->input('searchquery')]);
    }

    public function showEditProduct($id = null)
    {
        //$user = \Auth::user();
        $product = new \App\Models\Product();

        // This is an edit, see if the user can edit product
        if($id != null)
        {
            $product = $this->dataAccess->getProduct($id, 'allergens');
            if(!isset($product) || \Session::get(config('app.session_key_vendor')) != $product->vendor_id)
            {
                // Product came back null or doesn't belong to this vendor, see product to new
                $product = new \App\Models\Product();
            }
        }

        $allergens = $this->lookupManager->getProductAllergens();

        return view('product.edit')->with(['product' => $product, 'allergens' => $allergens]);
    }

    public function editProduct(Request $request)
    {
        $user = \Auth::user();
        $productId = $request->input('id');
        $vendorId = \Session::get(config('app.session_key_vendor'));

        if(isset($vendorId))
        {
            // Now validate user product
            $productValidator = $this->productValidator($request->all());
            if ($productValidator->fails())
            {
                $this->throwValidationException($request, $productValidator);
            }

            $product = $this->dataAccess->upsertProduct($productId, $vendorId, $request->all());

            // Update cache entry
            $this->updateProductCache($product, 'UPDATE');

            return redirect('product/detail/' . $product->id)->with('successMessage', trans('messages.product_update_success'));;
        }

        return redirect('product/detail/' . $productId);
    }

    public function vendorProducts()
    {
        $products = array();
        if(\Session::has(config('app.session_key_vendor')))
        {
            $products = $this->dataAccess->getProductsByVendor(\Session::get(config('app.session_key_vendor')), ['id', 'name'], true, 20);
        }

        return view('profile.products')->with('products', $products);
    }

    protected function productValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:500',
            'description' => 'required',
        ]);
    }

    private function updateProductCache($product, $action)
    {
        if($action == 'UPDATE')
        {
            // Update cache entry
            $cacheKey = 'product-'.$product->id;
            $this->cacheManager->setItem(env('CACHE_DRIVER'), $cacheKey, $product, config('app.cache_expiry_time_products'));
        }
    }
}