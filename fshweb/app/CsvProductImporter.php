<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 01/11/2015
 * Time: 2:51 PM
 */

namespace App;


class CsvProductImporter implements iProductImporter
{

    public function doImport($data)
    {
        var_dump($data);
    }
}