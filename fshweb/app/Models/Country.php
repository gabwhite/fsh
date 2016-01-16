<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 16/01/2016
 * Time: 1:27 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $primaryKey = 'id';

    protected $fillable =
        [
            'name', 'active'
        ];

    public function stateProvinces()
    {
        return $this->hasMany('\App\Models\StateProvince');
    }
}