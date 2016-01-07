<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 22/11/2015
 * Time: 11:32 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $primaryKey = 'id';

    protected $fillable =
        [
            'user_id',
            'company_name', 'address1', 'address2', 'city', 'state_province', 'country', 'zip_postal',
            'contact_name', 'contact_title', 'contact_phone', 'contact_url',
            'intro_text', 'about_text', 'logo_image_path', 'background_image_path'
        ];


    public function users()
    {
        return $this->belongsToMany('\App\Models\User');
    }

    public function brands()
    {
        return $this->hasMany('\App\Models\VendorBrand');
    }

}