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
        return view('productdetail');
    }

    public function fullTextSearch(Request $request)
    {
        $words = explode(' ', $request->input('searchquery'));
        $productSearcher = new ProductSearcher();
        $results = $productSearcher->fullTextSearch('breenindex', $words);

        return view('search')->with('searchresults', $results)->with('query', $request->input('searchquery'));
    }

}
