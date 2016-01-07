<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 08/11/2015
 * Time: 1:19 AM
 */

namespace App;

use ZendSearch;
use ZendSearch\Lucene\Lucene;
use ZendSearch\Lucene\Search\Query;
use ZendSearch\Lucene\Index\Term;
use ZendSearch\Lucene\Analysis\Analyzer\Analyzer;
use ZendSearch\Lucene\Analysis\Analyzer\Common\Utf8;
use ZendSearch\Lucene\Search\QueryParser;

class ProductSearcher
{
    public function fullTextSearch($index, $query)
    {
        Analyzer::setDefault(new Utf8());
        Lucene::setResultSetLimit(25);

        $words = explode(' ', $query);
        $finalWords = array();
        //$query = new Query\MultiTerm();
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

            //$query->addTerm(new Term($w), true);
        }

        //dd($finalWords);

        //$luceneQuery = QueryParser::parse($query);
        $luceneQuery = QueryParser::parse(implode(' ', $finalWords));

        $index = Lucene::open(storage_path('app/lucene/' . $index));
        $results = $index->find($luceneQuery);

        //dd($results);

        return $results;
    }

    public function getProductsByCategory($categoryId)
    {
        $products = \DB::table('products')
            ->join('product_categories', 'products.id', '=', 'product_categories.product_id')
            ->where('product_categories.category_id', '=', $categoryId)
            //->where('products.published', '=', true)
            ->select('products.id', 'products.name', 'products.brand')->orderBy('products.name')->get();

        return $products;
    }

    public function getProductsByCategoryPaginated($categoryId, $pageSize, $isSimplePaginate)
    {
        if ($isSimplePaginate)
        {
            $products = \DB::table('products')
                ->join('product_categories', 'products.id', '=', 'product_categories.product_id')
                ->where('product_categories.category_id', '=', $categoryId)
                //->where('products.published', '=', true)
                ->select('products.id', 'products.name', 'products.brand')->simplePaginate($pageSize);

            return $products;
        }
        else
        {
            $products = \DB::table('products')
                ->join('product_categories', 'products.id', '=', 'product_categories.product_id')
                ->where('product_categories.category_id', '=', $categoryId)
                //->where('products.published', '=', true)
                ->select('products.id', 'products.name', 'products.brand')->paginate($pageSize);

            return $products;
        }
    }
}