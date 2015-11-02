<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 01/11/2015
 * Time: 2:49 PM
 */

namespace App;


interface iProductImporter
{
    public function doImport($data);
}