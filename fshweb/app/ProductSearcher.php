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
}