<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'food_categories';

    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

}
