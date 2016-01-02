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
        'firstname', 'lastname', 'bio', 'vendor_id',
        'company', 'address1', 'address2', 'country', 'state_province', 'city', 'zip_postal',
        'contact_name', 'contact_title', 'contact_phone', 'logo_image_path'
    ];

    public function user()
    {
        return $this->belongsTo('\App\Model\User', 'id');
    }
}