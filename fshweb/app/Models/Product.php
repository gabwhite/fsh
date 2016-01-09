<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable =
        [
            'vendor_id',
            'uniquekey', 'name', 'description', 'brand',
            'pack', 'calc_size', 'mpc', 'broker_contact', 'allergen_disclaimer',
            'features_benefits', 'ingredient_deck', 'uom',
            'gtin', 'calories', 'calories_from_fat', 'saturated_fats', 'total_fat',
            'sodium', 'fibre', 'sugar', 'protein', 'carbs', 'net_weight', 'gross_weight',
            'tare_weight', 'is_halal', 'is_organic', 'is_kosher', 'serving_size', 'calculation_size_uom',
            'serving_size_uom', 'preparation', 'size', 'vendor_logo', 'product_image', 'pos_pdf', 'published'
        ];

    public function allergens()
    {
        return $this->belongsToMany('App\Models\Allergen', 'product_allergens', 'product_id', 'allergen_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'product_categories', 'product_id', 'category_id');
    }
}
