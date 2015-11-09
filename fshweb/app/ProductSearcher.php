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

class ProductSearcher
{
    public function fullTextSearch($index, $words)
    {
        Analyzer::setDefault(new Utf8());
        Lucene::setResultSetLimit(10);

        $query = new Query\MultiTerm();
        foreach($words as $w)
        {
            $query->addTerm(new Term($w), true);
        }

        $index = Lucene::open(storage_path('app/lucene/' . $index));
        $results = $index->find($query);

        return $results;
    }

    public function getUserProductsByCategory($categoryId)
    {
        $products = \DB::table('user_products')
            ->join('user_products_categories', 'user_products.id', '=', 'user_products_categories.product_id')
            ->where('user_products_categories.category_id', '=', $categoryId)
            //->where('user_products.published', '=', true)
            ->select('user_products.id', 'user_products.name', 'user_products.brand')->orderBy('user_products.name')->get();

        return $products;
    }

    public function getUserProductsByCategoryPaginated($categoryId, $pageSize, $isSimplePaginate)
    {
        if ($isSimplePaginate)
        {
            $products = \DB::table('user_products')
                ->join('user_products_categories', 'user_products.id', '=', 'user_products_categories.product_id')
                ->where('user_products_categories.category_id', '=', $categoryId)
                //->where('user_products.published', '=', true)
                ->select('user_products.id', 'user_products.name', 'user_products.brand')->simplePaginate($pageSize);

            return $products;
        }
        else
        {
            $products = \DB::table('user_products')
                ->join('user_products_categories', 'user_products.id', '=', 'user_products_categories.product_id')
                ->where('user_products_categories.category_id', '=', $categoryId)
                //->where('user_products.published', '=', true)
                ->select('user_products.id', 'user_products.name', 'user_products.brand')->paginate($pageSize);

            return $products;
        }
    }
}