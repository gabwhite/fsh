<?php

namespace App\Http\Controllers;

use App\DbCategoryFinder;
use App\ProductSearcher;
use Illuminate\Http\Request;
use Cache;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{

    public function getFoodCategoriesForParent($format, $parentId = null)
    {
        $categoryFinder = new DbCategoryFinder();

        //$categories = \App\Models\Category::where('parent_id', '=', $parentId)->get();
        $categories = $categoryFinder->getFoodCategoriesForParent($parentId);

        if($format == 'JSON')
        {
            return $categories->toJson();
        }
        else if($format == 'TREEJSON')
        {
            // Build custom JSON object for JSTREE javascript plugin
            $json = [];
            foreach($categories as $c)
            {
                $oneObj['id'] = $c->id;
                $oneObj['text'] = $c->name;
                $oneObj['state'] = ['opened' => false, 'disabled' => false, 'selected' => false];
                $oneObj['children'] = true;

                array_push($json, $oneObj);
            }

            return response()->json($json);
        }
    }

    public function getUserProducts($categoryId)
    {

        $productSearcher = new ProductSearcher();
        //$products = $productSearcher->getUserProductsByCategoryPaginated($categoryId, 3, true);
        $products = $productSearcher->getUserProductsByCategory($categoryId);

        return response()->json($products);
    }

    public function getUserProductsFullText($words)
    {
        $productSearcher = new ProductSearcher();
        $products = $productSearcher->fullTextSearch('productindex', $words);

        return $products;
    }

    public function getCountries()
    {
        $countries = Cache::remember('countries', 5, function()
        {
            return \DB::table('countries')->where('active', '=', '1')->get();
        });

        return response()->json($countries);
    }

    public function getStateProvincesForCountry($countryId)
    {
        $key = 'stateprovince-' . $countryId;

        $stateProvinces = Cache::remember($key, 5, function() use ($countryId)
        {
            return \DB::table('stateprovinces')->where('country_id', '=', $countryId)->get();
        });

        return response()->json($stateProvinces);
    }

}
