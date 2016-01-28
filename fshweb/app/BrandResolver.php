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

    public static function resolve($brandName)
    {
        $brandImage = null;
        if(stripos($brandName, 'lantic') !== false)
        {
            $brandImage = 'lantic.jpg';
        }
        else if(stripos($brandName, 'rogers') !== false)
        {
            $brandImage = 'rogers.jpg';
        }
        else if(stripos($brandName, 'roland') !== false)
        {
            $brandImage = 'roland.png';
        }

        return $brandImage;
    }
}