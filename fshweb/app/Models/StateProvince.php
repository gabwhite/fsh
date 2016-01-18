<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 16/01/2016
 * Time: 1:29 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateProvince extends Model
{
    protected $table = 'stateprovinces';

    protected $primaryKey = 'id';

    protected $fillable =
        [
            'name', 'country_id', 'active'
        ];

    public function country()
    {
        return $this->hasOne('\App\Models\Country');
    }
}