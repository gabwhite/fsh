<?php
/**
 * Created by PhpStorm.
 * User: byoung
 * Date: 1/7/2016
 * Time: 12:22 PM
 */

namespace App\Http\Controllers;

use App\DataAccessLayer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    protected $dataAccess;

    public function __construct(DataAccessLayer $dataAccess)
    {
        $this->dataAccess = $dataAccess;
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

    public function fullTextSearch(Request $request)
    {

        $productSearcher = new ProductSearcher();
        $hits = $productSearcher->fullTextSearch('productindex', $request->input('searchquery'));

        $results = array();
        foreach($hits as $h)
        {
            $data = array('score' => $h->score, 'document' => $h->getDocument());
            array_push($results, $data);
        }

        return view('search')->with('searchresults', $results)->with('query', $request->input('searchquery'));
    }

    public function showProduct($id = null)
    {
        $product = new \App\Models\Product();
        if($id != null)
        {
            $product = $this->dataAccess->getProduct($id);
            if($product == null) { $product = new \App\Models\Product(); }
        }

        return view('product.edit')->with('product', $product);
    }

    public function editProduct(Request $request)
    {
        $user = \Auth::user();
        $productId = $request->input('id');
        $isAdd = false;

        // Now validate / create user product
        $productValidator = $this->productValidator($request->all());
        if ($productValidator->fails())
        {
            $this->throwValidationException($request, $productValidator);
        }

        $product = $this->dataAccess->getProductByIdUser($productId, $user->id);
        if(!$product)
        {
            // New user product
            $product = new \App\Models\Product();
            $product->vendor_id = $user->id;
            //$product->uniquekey = (isset($row[8])) ? $row[8] : $row[11]; // MPC or GTIN

            $isAdd = true;
        }

        $product->name = $request->input('name');
        $product->brand = $request->input('brand');
        $product->pack = $request->input('pack');
        $product->size = $request->input('size');
        $product->uom = $request->input('uom');
        $product->serving_size_uom = $request->input('serving_size_uom');
        $product->mpc = $request->input('mpc');
        $product->broker_contact = $request->input('broker_contact');
        $product->gtin = $request->input('gtin');
        $product->is_halal = ($request->input('is_halal') ? 1 : 0);
        $product->is_organic = ($request->input('is_organic') ? 1 : 0);
        $product->is_kosher = ($request->input('is_kosher') ? 1 : 0);
        $product->calc_size = $request->input('calc_size');
        $product->calculation_size_uom = $request->input('calculation_size_uom');
        $product->calories = $request->input('calories');
        $product->calories_from_fat = $request->input('calories_from_fat');
        $product->protein = $request->input('protein');
        $product->carbs = $request->input('carbs');
        $product->fibre = $request->input('fibre');
        $product->sugar = $request->input('sugar');
        $product->total_fat = $request->input('total_fat');
        $product->saturated_fats = $request->input('saturated_fats');
        $product->sodium = $request->input('sodium');
        $product->product_image = $request->input('product_image');
        $product->description = $request->input('description');
        $product->preparation = $request->input('preparation');
        $product->ingredient_deck = $request->input('ingredient_deck');
        $product->features_benefits = $request->input('features_benefits');
        $product->allergen_disclaimer = $request->input('allergen_disclaimer');
        $product->net_weight = $request->input('net_weight');
        $product->gross_weight = $request->input('gross_weight');
        $product->tare_weight = $request->input('tare_weight');
        $product->serving_size = $request->input('serving_size');
        $product->vendor_logo = $request->input('vendor_logo');
        $product->pos_pdf = $request->input('pos_pdf');
        $product->published = ($request->input('published') ? 1 : 0);

        $product->save();

        return redirect('product/detail/' . $product->id)->with('successMessage', trans('messages.product_update_success'));;
    }

    public function vendorProducts()
    {
        $user = \Auth::user();

        $products = \App\Models\Product::where('user_id', '=', $user->id)->orderby('name')->paginate(20);

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