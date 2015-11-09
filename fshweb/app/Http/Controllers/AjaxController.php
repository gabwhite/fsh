<?php

namespace App\Http\Controllers;

use App\ProductSearcher;
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

}
