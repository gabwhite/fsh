<?php

namespace App\Http\Controllers;

use App\CacheManager;
use App\DataAccessLayer;
use App\DbCategoryFinder;
use App\ProductSearcher;
use Illuminate\Http\Request;
use Cache;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{

    protected $dataAccess;
    protected $cacheManager;

    /**
     * AjaxController constructor.
     * @param $dataAccess
     */
    public function __construct(DataAccessLayer $dataAccess, CacheManager $cacheManager)
    {
        $this->dataAccess = $dataAccess;
        $this->cacheManager = $cacheManager;
    }

    public function getProductFullTextSearch($query)
    {
        $productSearcher = new ProductSearcher();
        $hits = $productSearcher->fullTextSearch('productindex', $query);

        $results = array();
        foreach($hits as $h)
        {
            $d = $h->getDocument();
            $fieldNames = $d->getFieldNames();

            $fields = array();
            foreach($fieldNames as $fn)
            {
                $fv = $d->getFieldValue($fn);
                $fields[$fn] = $fv;
            }

            $data = array('score' => $h->score, 'fields' => $fields);
            array_push($results, $data);
        }

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
        $countries = $this->cacheManager->getItem(env('CACHE_DRIVER'), 'countries');

        if($countries == null)
        {
            $countries = $this->dataAccess->getAllCountries();
            $this->cacheManager->setItem(env('CACHE_DRIVER'), 'countries', $countries, 10);
        }

        return response()->json($countries);
    }

    public function getStateProvincesForCountry($countryId)
    {


        $key = 'stateprovince-' . $countryId;

        $stateProvinces = Cache::remember($key, 5, function() use ($countryId)
        {
            return $this->dataAccess->getStateProvincesForCountry($countryId);
        });

        return response()->json($stateProvinces);
    }

}
