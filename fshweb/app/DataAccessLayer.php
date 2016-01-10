<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 06/12/2015
 * Time: 10:31 PM
 */

namespace App;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use App\Models\VendorBrand;

use \Illuminate\Support\Facades\DB;

class DataAccessLayer
{

    public function getUsersForRole($roleId)
    {
        return Role::find($roleId)->users()->get();
    }

    public function getAllUsers()
    {
        return  User::with('roles')->get();
    }

    public function getUser($userId, $relationships = null)
    {
        if(isset($relationships))
        {
            return User::where('id', '=', $userId)->with($relationships)->first();
        }

        return User::where('id', '=', $userId)->first();
    }

    public function getAllRoles($relationships = null)
    {
        if(isset($relationships))
        {
            return Role::with($relationships)->get();
        }
        return Role::all();
    }

    public function getAllPermissions()
    {
        return Permission::all();
    }

    public function getProduct($productId, $relationships = null)
    {
        if(isset($relationships))
        {
            return Product::where('id', '=', $productId)->with($relationships)->first();
        }

        return Product::where('id', '=', $productId)->first();
    }

    public function getProductByIdUser($productId, $userId)
    {
        return Product::where(['id' => $productId, 'vendor_id' => $userId])->first();
    }

    public function upsertProduct($productId, $userId, $data)
    {
        $product = $this->getProductByIdUser($productId, $userId);

        $isAdd = false;
        if(!$product)
        {
            // New user product
            $product = new Product();
            $product->vendor_id = $userId;
            //$product->uniquekey = (isset($row[8])) ? $row[8] : $row[11]; // MPC or GTIN
            $isAdd = true;
        }

        $product->name = $data['name'];
        $product->brand = (isset($data['brand']) ? $data['brand'] : null);
        $product->pack = (isset($data['pack']) ? $data['pack'] : null);
        $product->size = (isset($data['size']) ? $data['size'] : null);
        $product->uom = (isset($data['uom']) ? $data['uom'] : null);
        $product->serving_size_uom = (isset($data['serving_size_uom']) ? $data['serving_size_uom'] : null);
        $product->mpc = (isset($data['mpc']) ? $data['mpc'] : null);
        $product->broker_contact = (isset($data['broker_contact']) ? $data['broker_contact'] : null);
        $product->gtin = (isset($data['gtin']) ? $data['gtin'] : null);
        $product->is_halal = (isset($data['is_halal']) ? 1 : 0);
        $product->is_organic = (isset($data['is_organic']) ? 1 : 0);
        $product->is_kosher = (isset($data['is_kosher']) ? 1 : 0);
        $product->calc_size = (isset($data['calc_size']) ? $data['calc_size'] : null);
        $product->calculation_size_uom = (isset($data['calculation_size_uom']) ? $data['calculation_size_uom'] : null);
        $product->calories = (isset($data['calories']) ? $data['calories'] : null);
        $product->calories_from_fat = (isset($data['calories_from_fat']) ? $data['calories_from_fat'] : null);
        $product->protein = (isset($data['protein']) ? $data['protein'] : null);
        $product->carbs = (isset($data['carbs']) ? $data['carbs'] : null);
        $product->fibre = (isset($data['fibre']) ? $data['fibre'] : null);
        $product->sugar = (isset($data['sugar']) ? $data['sugar'] : null);
        $product->total_fat = (isset($data['total_fat']) ? $data['total_fat'] : null);
        $product->saturated_fats = (isset($data['saturated_fats']) ? $data['saturated_fats'] : null);
        $product->sodium = (isset($data['sodium']) ? $data['sodium'] : null);
        $product->product_image = (isset($data['product_image']) ? $data['product_image'] : null);
        $product->description = (isset($data['description']) ? $data['description'] : '');
        $product->preparation = (isset($data['preparation']) ? $data['preparation'] : null);
        $product->ingredient_deck = (isset($data['ingredient_deck']) ? $data['ingredient_deck'] : null);
        $product->features_benefits = (isset($data['features_benefits']) ? $data['features_benefits'] : null);
        $product->allergen_disclaimer = (isset($data['allergen_disclaimer']) ? $data['allergen_disclaimer'] : null);
        $product->net_weight = (isset($data['net_weight']) ? $data['net_weight'] : null);
        $product->gross_weight = (isset($data['gross_weight']) ? $data['gross_weight'] : null);
        $product->tare_weight = (isset($data['tare_weight']) ? $data['tare_weight'] : null);
        $product->serving_size = (isset($data['serving_size']) ? $data['serving_size'] : null);
        $product->vendor_logo = (isset($data['vendor_logo']) ? $data['vendor_logo'] : null);
        $product->pos_pdf = (isset($data['pos_pdf']) ? $data['pos_pdf'] : null);
        $product->published = (isset($data['published']) ? 1 : 0);

        $product->save();

        return $product->id;

    }

    public function getFoodCategoriesForParent($parentId = null)
    {
       return Category::where('parent_id', '=', $parentId)->get();
    }

    public function getAllFoodCategories($activeOnly = true)
    {
        if($activeOnly)
        {
            return $categories = Category::where('active', '=', 1)->get();
        }

        return Category::all();
    }

    public function getAllCountries($activeOnly = true)
    {
        if($activeOnly)
        {
            return DB::table('countries')->where('active', '=', '1')->get();
        }

        return DB::table('countries')->get();

    }

    public function getStateProvincesForCountry($countryId)
    {
        return DB::table('stateprovinces')->where('country_id', '=', $countryId)->get();
    }

    public function getProductsByFullText($arrTerms)
    {

        $terms = implode(' ', $arrTerms);

        $query = "MATCH (name, description, gtin, mpc, brand, ingredient_deck) AGAINST ('$terms' IN BOOLEAN MODE)";
        $products = Product::select('id', 'name', 'brand')->whereRaw($query)->get();

        return $products;
    }

    public function isVendorOwner($userId, $vendorId)
    {
        return ($this->getVendorOwner($vendorId) == $userId);
    }

    public function getVendorsForUser($userId)
    {
        $vendors = Vendor::where('user_id', '=', $userId)->select('id')->get();

        return $vendors;

    }

    public function isUserVendorOwner($userId, $vendorId)
    {
        $vendors = $this->getVendorsForUser($userId);

        $v = array_first($vendors, function($key, $val) use ($vendorId)
        {
            return $val == $vendorId;
        }, null);

        if($v == null) { return false; } else { return true; }
    }

    public function getVendorOwner($vendorId)
    {
        $owner = Vendor::where('id', '=', $vendorId)->select('user_id')->first();

        if(isset($owner))
        {
            return $owner->user_id;
        }

        return null;
    }

    public function getVendor($vendorId)
    {
        $vendor = Vendor::find($vendorId);

        return $vendor;
    }

    public function getBrandsForVendor($vendorId)
    {
        $brands = VendorBrand::where('vendor_id', '=', $vendorId)->get();

        return $brands;
    }

    public function getVendors($fields = null)
    {
        if(isset($fields))
        {
            $vendors = Vendor::select($fields)->orderBy('company_name', 'desc')->get();
        }
        else
        {
            $vendors = Vendor::orderBy('company_name', 'desc')->get();
        }


        return $vendors;
    }

    public function upsertBrand($vendorId, $data)
    {

    }

    public function getAllAllergens($activeOnly = true)
    {
        if($activeOnly)
        {
            return DB::table('allergens')->where('active', '=', '1')->get();
        }

        return DB::table('allergens')->get();

    }

}