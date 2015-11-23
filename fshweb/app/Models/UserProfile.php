<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 22/11/2015
 * Time: 11:32 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }
}