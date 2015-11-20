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

    public function getFoodCategoryDeepTree($parentId = null)
    {
        // If parent id is null, get the ENTIRE tree
        $treeData = array();

        $rootCategories = \App\Models\Category::where('parent_id', '=', $parentId)->get();

    }

}