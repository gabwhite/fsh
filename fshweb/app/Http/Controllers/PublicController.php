<?php

namespace App\Http\Controllers;

use App\DataAccessLayer;
use App\ProductSearcher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class PublicController extends Controller
{
    protected $dataAccess;

    /**
     * PublicController constructor.
     * @param $dataAccess
     */
    public function __construct(DataAccessLayer $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function productDetail($id)
    {
        $userProduct = $this->dataAccess->getUserProduct($id);

        return view('productdetail')->with('userproduct', $userProduct);
    }

    public function fullTextSearch(Request $request)
    {

        $productSearcher = new ProductSearcher();
        $hits = $productSearcher->fullTextSearch('productindex', $request->input('searchquery'));

        $results = array();
        foreach($hits as $h)
        {
            $data = array('score' => $h->score, 'document' => $h->getDocument());
            array_push($results, $data);
        }

        return view('search')->with('searchresults', $results)->with('query', $request->input('searchquery'));
    }

}
