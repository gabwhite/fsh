<?php
/**
 * Created by PhpStorm.
 * User: byoung
 * Date: 11/6/2015
 * Time: 10:37 AM
 */

namespace App;


interface iSearchIndexBuilder
{
    public function buildIndex($data);
}