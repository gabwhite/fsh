<?php

namespace App\Http\Controllers;

use App\DataAccessLayer;
use App\LookupManager;
use Illuminate\Http\Request;
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

    public function getFoodCategoriesForParent($format, $parentId = null)
    {
        $categories = $this->lookupManager->getFoodCategoriesForParent($parentId);

        if($format == 'TREEJSON')
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

            $categories = $json;
        }

        //return $categories->toJson();
        return response()->json($categories);
    }

    public function getProducts(Request $request, $query = null)
    {
        $sort = $request->input('sort') ? $request->input('sort') : config('app.search_default_sort');
        $pageSize = $request->input('pageSize') ? $request->input('pageSize') : config('app.search_default_page_size');
        $searchType = $request->input('type') ? $request->input('type') : 'fc';

        $fields = ['products.id', 'products.name', 'products.brand', 'products.pack', 'products.uom', 'products.mpc', 'products.calc_size', 'products.description'];

        $products = null;
        if($searchType === 'fc')
        {
            if(isset($query))
            {
                $products = $this->dataAccess->getProductsByCategory($query, $fields, false, $sort, true, $pageSize);
            }
            else
            {
                $products = $this->dataAccess->getAllProducts($fields, null, false, $sort, true, $pageSize);
            }
        }
        else if($searchType === 'ft')
        {
            $products = $this->dataAccess->getProductsByFullText($query, $fields, $sort, true, $pageSize);
        }

        $view = \View::make('product.productresults', ['products' => $products, 'sort' => $sort, 'pageSize' => $pageSize, 'type' => $searchType]);

        $returnData = ['sort' => $sort, 'type' => $searchType, 'pageSize' => $pageSize, 'query' => $query, 'view' => $view->render()];

        return response()->json($returnData);
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
