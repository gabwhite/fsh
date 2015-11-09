<?php

namespace App\Http\Controllers;

use App\ProductSearcher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class PublicController extends Controller
{
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
        $userProduct = \App\Models\UserProduct::where('id', '=', $id)->first();

        return view('productdetail')->with('userproduct', $userProduct);
    }

    public function fullTextSearch(Request $request)
    {
        $words = explode(' ', $request->input('searchquery'));
        $productSearcher = new ProductSearcher();
        $hits = $productSearcher->fullTextSearch('productindex', $words);

        $results = array();
        foreach($hits as $h)
        {
            $data = array('score' => $h->score, 'document' => $h->getDocument());
            array_push($results, $data);
        }

        return view('search')->with('searchresults', $results)->with('query', $request->input('searchquery'));
    }

}
