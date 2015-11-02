<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 01/11/2015
 * Time: 2:51 PM
 */

namespace App;

use Ramsey\Uuid\Uuid;
use League\Csv\Reader;

class CsvProductImporter implements iProductImporter
{

    public function doImport($data)
    {

        //$userProductImport = new UserProductImport();
        //$userProductImport->user_id = $data['user_id'];
        //$userProductImport->uuid = $data['uuid'];
        //$userProductImport->filename = $data['filename'];
        //$userProductImport->save();

        $fileContents = \Storage::get($data['uuid'] . '/' .  $data['filename']);
        $csv = Reader::createFromString($fileContents);
        $csv->setDelimiter(',');
        if($data['include_headers'])
        {
            $csv->setOffset(1); //because we don't want to insert the header
        }

        $csv->each(function ($row)
        {
            var_dump($row);
        });


    }
}