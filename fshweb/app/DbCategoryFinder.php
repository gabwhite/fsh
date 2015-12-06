<?php
/**
 * Created by PhpStorm.
 * User: byoung
 * Date: 11/9/2015
 * Time: 3:41 PM
 */

namespace App;


class DbCategoryFinder implements iCategoryFinder
{
    public function getFoodCategoriesForParent($parentId = null)
    {
        $categories = \App\Models\Category::where('parent_id', '=', $parentId)->get();

        return $categories;
    }

    public function getAllFoodCategories()
    {
        $categories = \App\Models\Category::where('active', '=', 1)->get();

        return $categories;
    }

}