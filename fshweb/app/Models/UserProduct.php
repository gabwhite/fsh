<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    protected $table = 'user_products';

    public function allergens()
    {
        return $this->belongsToMany('App\Allergen', 'user_products_allergens');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'user_products_categories');
    }
}
