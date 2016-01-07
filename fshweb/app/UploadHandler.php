<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 26/11/2015
 * Time: 12:16 AM
 */

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;
use Intervention\Image\ImageManagerStatic as Image;

class UploadHandler
{
    public function generateUniqueFilename($extension)
    {
        return Uuid::uuid4()->toString() . "." . $extension;
    }

    public function uploadCsv($file, $directory, $filename)
    {
        $success = false;

        if($file->getClientOriginalExtension() == 'csv')
        {
            try
            {

                if ($file->isValid())
                {
                    //$file->move($path, $fileName);
                    //\Storage::disk('imports')->put($directory . '/' . $filename, \File::get($file));
                    \Storage::disk('imports')->put($directory . '/' . $filename, fopen($file->getRealPath(), 'r'));
                }
            }
            catch(Exception $ex)
            {
                throw $ex;
            }

            //$this->uploadFile($file, $filename, storage_path(config('app.csv_storage') . '/' . $directory));
            $success = true;
        }

        return $success;
    }

    public function uploadAvatar($file, $avatarFilename = null)
    {
        if(!isset($avatarFilename))
        {
            $avatarFilename = $this->generateUniqueFilename($file->getClientOriginalExtension());
        }

        $this->uploadFile($file, $avatarFilename, public_path(config('app.avatar_storage')));

        return $avatarFilename;
    }

    public function removeAvatar($file)
    {
        try
        {
            Storage::disk('avatars')->delete($file);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function uploadFile($file, $fileName, $path)
    {
        try
        {
            if ($file->isValid())
            {
                $file->move($path, $fileName);
            }
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function cropAvatar($fileName, $cropData)
    {
        $this->cropImage(public_path(config('app.avatar_storage')), $fileName, $cropData);
    }

    public function cropVendorAsset($fileName, $cropData)
    {
        $this->cropImage(public_path(config('app.vendor_storage')), $fileName, $cropData);
    }

    public function cropImage($path, $fileName, $cropData)
    {
        // $cropData is an array with the following order:
        // width, height, x, y, rotate, scaleX, scaleY

        $img = Image::make($path . '/' .  $fileName)->crop(ceil($cropData[0]), ceil($cropData[1]), ceil($cropData[2]), ceil($cropData[3]));
        $img->save();
    }
}