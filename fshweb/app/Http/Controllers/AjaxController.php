<?php

namespace App\Http\Controllers;

use App\CacheManager;
use App\DataAccessLayer;
use App\DbCategoryFinder;
use App\LookupManager;
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
        $results = $this->dataAccess->getProductsByFullText($query, ['id', 'name', 'brand', 'pack', 'uom', 'mpc', 'calc_size', 'description'], 'name', true, 10);

        $view = \View::make('product.productresults', ['products' => $results, 'sort' => 'name', 'pageSize' => 10]);

        return response()->json($view->render());

        //return response()->json($results);
    }

    public function getFoodCategoriesForParent($format, $parentId = null)
    {
        $categories = $this->lookupManager->getFoodCategoriesForParent($parentId);

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

    public function getProducts($categoryId = null)
    {
        if(isset($categoryId))
        {
            $products = $this->dataAccess->getProductsByCategory($categoryId, true, 10);
        }
        else
        {
            $products = $this->dataAccess->getAllProducts(['id', 'name', 'brand', 'pack', 'calc_size', 'uom', 'mpc'], null, false, 'name', true, 10);
        }

        $view = \View::make('product.productresults', ['products' => $products, 'sort' => 'name', 'pageSize' => '10']);

        return response()->json($view->render());
        //return response()->json($products);
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
