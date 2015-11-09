<?php
/**
 * Created by PhpStorm.
 * User: byoung
 * Date: 11/6/2015
 * Time: 10:39 AM
 */

namespace App;

use Illuminate\Support\Facades\Storage;
use ZendSearch;


class LuceneSearchIndexBuilder implements iSearchIndexBuilder
{

    public function buildIndex($data)
    {

        if($data['action'] == 'CREATE')
        {
            $index = \ZendSearch\Lucene\Lucene::create(storage_path('app/lucene/' . $data['index_name']));

            $productsToIndex = \App\Models\UserProduct::all();
            foreach($productsToIndex as $p)
            {
                $doc = new \ZendSearch\Lucene\Document();

                $doc->addField(\ZendSearch\Lucene\Document\Field::unIndexed('id', $p->id));
                $doc->addField(\ZendSearch\Lucene\Document\Field::unIndexed('user_id', $p->user_id));
                $doc->addField(\ZendSearch\Lucene\Document\Field::text('name', $p->name));
                $doc->addField(\ZendSearch\Lucene\Document\Field::unStored('description', $p->description));
                $doc->addField(\ZendSearch\Lucene\Document\Field::text('brand', $p->brand));
                $doc->addField(\ZendSearch\Lucene\Document\Field::keyword('mpc', $p->mpc));
                $doc->addField(\ZendSearch\Lucene\Document\Field::keyword('gtin', $p->gtin));

                //$doc->addField(Zend_Search_Lucene_Field::UnIndexed('entry_id', $p->id));
                //$doc->addField(Zend_Search_Lucene_Field::Keyword('title', $p->title));
                //$doc->addField(Zend_Search_Lucene_Field::UnStored('contents', $p->body));

                $index->addDocument($doc);
            }
        }
        else if($data['action'] == 'REBUILD')
        {
            // Update existing index
            $index = \ZendSearch\Lucene\Lucene::open(storage_path('app/lucene/' . $data['index_name']));
            $hits = $index->find('path:' . storage_path('app/lucene/' . $data['index_name']));
            dd($hits);

        }



    }
}