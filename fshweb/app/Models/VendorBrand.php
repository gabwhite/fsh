<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 22/11/2015
 * Time: 11:32 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorBrands extends Model
{
    protected $table = 'vendor_brands';

    protected $primaryKey = 'id';

    protected $fillable =
        [
            'vendor_id', 'name', 'logo_image_path', 'active'
        ];

    public function vendor()
    {
        return $this->belongsTo('\App\Model\Vendor');
    }

}