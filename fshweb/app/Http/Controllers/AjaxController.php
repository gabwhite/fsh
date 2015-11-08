<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{

    public function getFoodCategoriesForParent($format, $parentId = null)
    {
        $categories = \App\Models\Category::where('parent_id', '=', $parentId)->get();

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
        $products = \DB::table('user_products')
            ->join('user_products_categories', 'user_products.id', '=', 'user_products_categories.product_id')
            ->where('user_products_categories.category_id', '=', $categoryId)
            //->where('user_products.published', '=', true)
            ->select('user_products.id', 'user_products.name', 'user_products.brand')->get();

        return response()->json($products);
    }

}
