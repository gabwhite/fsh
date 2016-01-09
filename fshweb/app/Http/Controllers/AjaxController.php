<?php

namespace App\Http\Controllers;

use App\CacheManager;
use App\DataAccessLayer;
use App\DbCategoryFinder;
use App\LookupManager;
use App\ProductSearcher;
use Illuminate\Http\Request;
use Cache;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{

    protected $dataAccess;
    protected $lookupManager;

    /**
     * AjaxController constructor.
     * @param $dataAccess
     */
    public function __construct(DataAccessLayer $dataAccess, LookupManager $lookupManager)
    {
        $this->dataAccess = $dataAccess;
        $this->lookupManager = $lookupManager;
    }

    public function getProductFullTextSearch($query)
    {

        $words = explode(' ', $query);
        $finalWords = array();
        foreach($words as $w)
        {
            if(is_numeric($w))
            {
                $w = '"'.$w.'"';
            }
            else if(!starts_with($w, '"') && strlen($w) > 2)
            {
                $w = $w . '*';
            }

            array_push($finalWords, $w);
        }

        $results = $this->dataAccess->getProductsByFullText($finalWords);

        return response()->json($results);
    }

    public function getFoodCategoriesForParent($format, $parentId = null)
    {
        $categories = $this->dataAccess->getFoodCategoriesForParent($parentId);

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

    public function getProducts($categoryId)
    {

        $productSearcher = new ProductSearcher();
        //$products = $productSearcher->getProductsByCategoryPaginated($categoryId, 3, true);
        $products = $productSearcher->getProductsByCategory($categoryId);

        return response()->json($products);
    }

    public function getProductsFullText($words)
    {
        $productSearcher = new ProductSearcher();
        $products = $productSearcher->fullTextSearch('productindex', $words);

        return $products;
    }

    public function getCountries()
    {
        $countries = $this->lookupManager->getCountries();

        return response()->json($countries);
    }

    public function getStateProvincesForCountry($countryId)
    {
        $stateProvinces = $this->lookupManager->getStateProvincesForCountry($countryId);

        return response()->json($stateProvinces);
    }

}
