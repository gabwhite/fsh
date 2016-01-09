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

}