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

    protected $primaryKey = 'user_id';

    protected $fillable =
    [
        'user_id',
        'firstname', 'lastname', 'bio', 'vendor_id', 'avatar_image_path'
    ];

    public function user()
    {
        return $this->belongsTo('\App\Model\User', 'id');
    }
}