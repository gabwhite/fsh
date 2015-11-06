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

            $productsToIndex = UserProduct::all();
            foreach($productsToIndex as $p)
            {
                $doc = new \ZendSearch\Lucene\Document();

                $doc->addField(\ZendSearch\Lucene\Document\Field::unIndexed('id', $p->id));
                $doc->addField(\ZendSearch\Lucene\Document\Field::unIndexed('user_id', $p->user_id));
                $doc->addField(\ZendSearch\Lucene\Document\Field::text('name', $p->name));
                $doc->addField(\ZendSearch\Lucene\Document\Field::unStored('description', $p->description));
                $doc->addField(\ZendSearch\Lucene\Document\Field::text('brand', $p->brand));
                $doc->addField(\ZendSearch\Lucene\Document\Field::text('mpc', $p->mpc));
                $doc->addField(\ZendSearch\Lucene\Document\Field::text('gtin', $p->gtin));
                $doc->addField(\ZendSearch\Lucene\Document\Field::unStored('allergen_disclaimer', $p->allergen_disclaimer));
                $doc->addField(\ZendSearch\Lucene\Document\Field::unStored('features_benefits', $p->features_benefits));
                $doc->addField(\ZendSearch\Lucene\Document\Field::unStored('ingredient_deck', $p->ingredient_deck));
                $doc->addField(\ZendSearch\Lucene\Document\Field::text('uom', $p->uom));
                $doc->addField(\ZendSearch\Lucene\Document\Field::unStored('preparation', $p->preparation));

                //$doc->addField(Zend_Search_Lucene_Field::UnIndexed('entry_id', $p->id));
                //$doc->addField(Zend_Search_Lucene_Field::Keyword('title', $p->title));
                //$doc->addField(Zend_Search_Lucene_Field::UnStored('contents', $p->body));

                $index->addDocument($doc);
            }
        }
        else
        {
            // Update existing index
        }



    }
}