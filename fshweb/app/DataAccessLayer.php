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

    public function isUsernameInUse($username)
    {
        $user = User::where('name', '=', $username)->select('id')->first();
        if(isset($user))
        {
            return true;
        }

        return false;
    }

    public function isEmailInUse($email, $old_email = null)
    {
        $query = User::where('email', '=', $email);
        if(isset($old_email))
        {
            $query->where('email', '!=', $old_email);
        }

        $user = $query->select('id')->first();
        if(isset($user))
        {
            return true;
        }

        return false;
    }

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

    public function deleteUser($userId)
    {
        $user = $this->getUser($userId);
        $user->delete();
    }

    public function addProductFavorite($userId, $productIds)
    {
        $user = $this->getUser($userId);
        if(isset($user))
        {
            $user->favoriteProducts()->attach($productIds);
        }
    }

    public function removeProductFavorite($userId, $productIds)
    {
        $user = $this->getUser($userId);
        if(isset($user))
        {
            $user->favoriteProducts()->detach($productIds);
        }
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

    public function getAllProducts($fields = null, $relationships = null, $publishedOnly = true, $sortBy = 'name', $paginate = false, $pageSize = 25)
    {
        if(isset($fields))
        {
            $query = Product::select($fields);
        }

        if(isset($relationships))
        {
            $query = $query->with($relationships);
        }

        if($publishedOnly)
        {
            $query = $query->where('published', '=', true);
        }

        $query = $query->orderBy($sortBy);

        if($paginate)
        {
            $products = $query->paginate($pageSize);
        }
        else
        {
            $products = $query->get();
        }

        return $products;

    }

    public function getProduct($productId, $relationships = null)
    {
        if(isset($relationships))
        {
            return Product::where('id', '=', $productId)->with($relationships)->first();
        }

        return Product::where('id', '=', $productId)->first();
    }

    public function getProductByIdVendor($productId, $vendorId, $fields = null, $relationships = null)
    {
        $query = Product::where(['id' => $productId, 'vendor_id' => $vendorId]);
        if(isset($fields))
        {
            $query->select($fields);
        }

        if(isset($relationships))
        {
            return $query->with($relationships);
        }

        return $query->first();
    }

    public function getProductsByVendor($vendorId, $fields = null, $paginate = false, $itemsPerPage = 20)
    {
        $query = Product::where('vendor_id', '=', $vendorId);
        if(isset($fields))
        {
            $query->select($fields);
        }

        if($paginate)
        {
            $products = $query->paginate($itemsPerPage);
        }
        else
        {
            $products = $query->get();
        }

        return $products;

    }

    public function updateProduct($productId, $userId, $data)
    {
        $product = $this->getProductByIdVendor($productId, $userId);
        if($product)
        {
            $product->update($data);

            $product->save();
        }

        return $product;
    }

    public function upsertProduct($productId, $userId, $data)
    {
        $product = $this->getProductByIdVendor($productId, $userId);

        $isAdd = false;
        if(!$product)
        {
            // New user product
            $product = new Product();
            $product->vendor_id = $userId;
            //$product->uniquekey = (isset($row[8])) ? $row[8] : $row[11]; // MPC or GTIN
            $isAdd = true;
        }

        $product->name = ucfirst(mb_strtolower($data['name']));
        $product->brand = (isset($data['brand']) ? ucfirst(mb_strtolower($data['brand'])) : null);
        if(isset($data['pack'])) { $product->pack = $data['pack']; }
        if(isset($data['size'])) { $product->size = $data['size']; }
        if(isset($data['uom'])) { $product->uom = $data['uom']; }
        if(isset($data['serving_size_uom'])) { $product->serving_size_uom = $data['serving_size_uom']; }
        if(isset($data['mpc'])) { $product->mpc = $data['mpc']; }
        if(isset($data['broker_contact'])) { $product->broker_contact = $data['broker_contact']; }
        if(isset($data['gtin'])) { $product->gtin = $data['gtin']; }
        $product->is_halal = (isset($data['is_halal']) ? 1 : 0);
        $product->is_organic = (isset($data['is_organic']) ? 1 : 0);
        $product->is_kosher = (isset($data['is_kosher']) ? 1 : 0);
        if(isset($data['calc_size'])) { $product->calc_size = $data['calc_size']; }
        if(isset($data['calculation_size_uom'])) { $product->calculation_size_uom = $data['calculation_size_uom']; }
        if(isset($data['calories'])) { $product->calories = $data['calories']; }
        if(isset($data['calories_from_fat'])) { $product->calories_from_fat = $data['calories_from_fat']; }
        if(isset($data['protein'])) { $product->protein = $data['protein']; }
        if(isset($data['carbs'])) { $product->carbs = $data['carbs']; }
        if(isset($data['fibre'])) { $product->fibre = $data['fibre']; }
        if(isset($data['sugar'])) { $product->sugar = $data['sugar']; }
        if(isset($data['total_fat'])) { $product->total_fat = $data['total_fat']; }
        if(isset($data['saturated_fats'])) { $product->saturated_fats = $data['saturated_fats']; }
        if(isset($data['sodium'])) { $product->sodium = $data['sodium']; }
        if(isset($data['product_image'])) { $product->product_image = $data['product_image']; }
        if(isset($data['description'])) { $product->description = $data['description']; }
        if(isset($data['preparation'])) { $product->preparation = $data['preparation']; }
        if(isset($data['ingredient_deck'])) { $product->ingredient_deck = $data['ingredient_deck']; }
        if(isset($data['features_benefits'])) { $product->features_benefits = $data['features_benefits']; }
        if(isset($data['allergen_disclaimer'])) { $product->allergen_disclaimer = $data['allergen_disclaimer']; }
        if(isset($data['net_weight'])) { $product->net_weight = $data['net_weight']; }
        if(isset($data['gross_weight'])) { $product->gross_weight = $data['gross_weight']; }
        if(isset($data['tare_weight'])) { $product->tare_weight = $data['tare_weight']; }
        if(isset($data['serving_size'])) { $product->serving_size = $data['serving_size']; }
        if(isset($data['vendor_logo'])) { $product->vendor_logo = $data['vendor_logo']; }
        if(isset($data['pos_pdf'])) { $product->pos_pdf = $data['pos_pdf']; }

        //$product->published = (isset($data['published']) ? 1 : 0);
        $product->published = $data['published'];

        // Sync allergens
        if(isset($data['allergens']))
        {
            $product->allergens()->sync($data['allergens']);
        }


        $product->save();

        return $product;

    }

    public function deleteProduct($productId, $userId = null)
    {
        $rowsAffected = 0;

        if(isset($userId))
        {
            $product = $this->getProductByIdVendor($productId, $userId);
        }
        else
        {
            $product = $this->getProduct($productId);
        }

        if(isset($product))
        {
            $rowsAffected = $product->delete();
        }

        return $rowsAffected;

    }

    public function getFoodCategoriesForParent($activeOnly = true, $parentId = null, $fields = null)
    {
        $query = Category::where('parent_id', '=', $parentId);
        if($activeOnly)
        {
            $query->where('active', '=', $activeOnly);
        }

        if(isset($fields))
        {
            $query->select($fields);
        }

       return $query->get();
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

    public function getAllUserTypes($activeOnly = true)
    {
        if($activeOnly)
        {
            return DB::table('user_types')->where('active', '=', '1')->orderBy('name', 'desc')->get();
        }

        return DB::table('user_types')->orderBy('name', 'desc')->get();
    }

    public function getStateProvincesForCountry($countryId)
    {
        return DB::table('stateprovinces')->where('country_id', '=', $countryId)->get();
    }

    public function getProductsByFullText($rawQuery, $fields, $orderBy, $paginate = false, $pageSize = 25)
    {
        $arrTerms = $this->prepareFullTextSearchQuery($rawQuery);

        $terms = implode(' ', $arrTerms);

        $query = "MATCH (name, description, gtin, mpc, brand, ingredient_deck) AGAINST ('$terms' IN BOOLEAN MODE)";

        if($paginate)
        {
            $products = Product::select($fields)->whereRaw($query)->orderBy($orderBy)->paginate($pageSize);
        }
        else
        {
            $products = Product::select($fields)->whereRaw($query)->orderBy($orderBy)->get();
        }


        return $products;
    }

    public function isVendorOwner($userId, $vendorId)
    {
        return ($this->getVendorOwner($vendorId) == $userId);
    }

    public function getVendorsForUser($userId, $fields = null)
    {
        $query = Vendor::where('user_id', '=', $userId);
        if(isset($fields))
        {
            $query->select($fields);
        }

        $vendors = $query->get();

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

    public function getVendor($vendorId, $fields = null, $relationships = null)
    {
        $query = Vendor::where('id', '=', $vendorId);
        if(isset($fields))
        {
            $query->select($fields);
        }

        if(isset($relationships))
        {
            $query->with($relationships);
        }

        $vendor = $query->first();

        return $vendor;
    }

    public function getBrand($brandId, $vendorId = null, $fields = null)
    {
        $query = VendorBrand::where('id', '=', $brandId);
        if(isset($vendorId))
        {
            $query->where('vendor_id', '=', $vendorId);
        }

        if(isset($fields))
        {
            $query->select($fields);
        }

        $brand = $query->first();

        return $brand;
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

    public function updateVendor($vendorId, $data)
    {
        $vendor = $this->getVendor($vendorId);

        if(isset($vendor))
        {
            if(isset($data['user_id'])) { $vendor->user_id = $data['user_id']; }
            if(isset($data['company_name'])) { $vendor->company_name = $data['company_name']; }
            if(isset($data['country_id'])) { $vendor->country_id = $data['country_id']; }
            if(isset($data['state_province_id'])) { $vendor->state_province_id = $data['state_province_id']; }
            if(isset($data['address1'])) { $vendor->address1 = $data['address1']; }
            if(isset($data['address2'])) { $vendor->address2 = $data['address2']; }
            if(isset($data['city'])) { $vendor->city = $data['city']; }
            if(isset($data['zip_postal'])) { $vendor->zip_postal = $data['zip_postal']; }
            if(isset($data['contact_name'])) { $vendor->contact_name = $data['contact_name']; }
            if(isset($data['contact_phone'])) { $vendor->contact_phone = $data['contact_phone']; }
            if(isset($data['contact_email'])) { $vendor->contact_email = $data['contact_email']; }
            if(isset($data['contact_url'])) { $vendor->contact_url = $data['contact_url']; }
            if(isset($data['intro_text'])) { $vendor->intro_text = $data['intro_text']; }
            if(isset($data['about_text'])) { $vendor->about_text = $data['about_text']; }

            $vendor->save();

            return $vendor;
        }

        return null;
    }

    public function deleteVendor($vendorId)
    {
        $rowsAffected = 0;

        $vendor = $this->getVendor($vendorId, ['id']);
        if(isset($vendor))
        {
            $rowsAffected = $vendor->delete();
        }

        return $rowsAffected;
    }


    public function insertBrand($data)
    {
        $brand = new VendorBrand();
        $brand->vendor_id = $data['vendor_id'];
        $brand->name = $data['name'];
        $brand->logo_image_path = $data['logo_image_path'];
        $brand->active = $data['active'] ? 1 : 0;

        $brand->save();

        return $brand->id;
    }

    public function deleteBrand($brandId, $vendorId)
    {
        $brand = $this->getBrand($brandId, $vendorId);
        if(isset($brand))
        {
            $rowsAffected = $brand->delete();
            return $rowsAffected;
        }

        return 0;
    }

    public function getAllAllergens($activeOnly = true)
    {
        if($activeOnly)
        {
            return DB::table('allergens')->where('active', '=', '1')->get();
        }

        return DB::table('allergens')->get();

    }

    public function getProductsByCategory($categoryId, $fields, $publishedOnly = true, $sortBy = 'name', $paginate = false, $pageSize = 25)
    {

        //$query = Product::select(['id', 'name'])->whereHas('categories', function($query) use($categoryId)
        //{
        //    $query->where('category_id', '=', $categoryId);
        //})->get();

        $query = \DB::table('products')->join('product_categories', 'products.id', '=', 'product_categories.product_id')
            ->where('product_categories.category_id', '=', $categoryId);

        if($publishedOnly) { $query = $query->where('products.published', '=', true); }
        if($fields) { $query =  $query->select($fields); }

        $query = $query->orderBy('products.' . $sortBy);

        if($paginate)
        {
            $products = $query->paginate($pageSize);
        }
        else
        {
            $products = $query->get();
        }

        return $products;

    }

    private function prepareFullTextSearchQuery($rawQuery)
    {
        $words = explode(' ', $rawQuery);
        $finalWords = array();
        foreach($words as $w)
        {
            if(is_numeric($w))
            {
                $w = '"'.$w.'"';
            }
            else if(!starts_with($w, '"') && mb_strlen($w) > 2)
            {
                $w = $w . '*';
            }

            array_push($finalWords, $w);
        }

        return $finalWords;
    }

}