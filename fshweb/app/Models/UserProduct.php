<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    protected $table = 'user_products';

    public function allergens()
    {
        return $this->belongsToMany('App\Models\Allergen', 'user_products_allergens', 'product_id', 'allergen_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'user_products_categories', 'product_id', 'category_id');
    }
}
