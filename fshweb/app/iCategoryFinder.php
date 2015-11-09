<?php
/**
 * Created by PhpStorm.
 * User: byoung
 * Date: 11/9/2015
 * Time: 3:53 PM
 */

namespace App;


interface iCategoryFinder
{
    public function getFoodCategoriesForParent($parentId = null);
}