<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 27/01/2016
 * Time: 8:21 PM
 */

namespace App;


class BrandResolver
{

    /**
     * BrandResolver constructor.
     */
    public function __construct()
    {
    }

    public static function Resolve($brandName)
    {
        $brandImage = '';
        if(stripos($brandName, 'lantic'))
        {

        }
        else if(stripos($brandName, 'Roland')) {}

        return $brandImage;
    }
}