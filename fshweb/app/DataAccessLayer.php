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
use App\Models\UserProduct;
use App\Models\Category;

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

    public function getUserProduct($productId)
    {
        return UserProduct::where('id', '=', $productId)->first();
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
}