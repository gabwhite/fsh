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
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadHandler
{

    //===================================================================
    // CSV Functions
    //===================================================================

    public function uploadCsv(UploadedFile $file, $directory, $filename)
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


    //===================================================================
    // Avatar Functions
    //===================================================================

    public function uploadAvatar(UploadedFile $file, $avatarFilename = null)
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

    public function cropAvatar($fileName, $cropData)
    {
        $this->cropImage(public_path(config('app.avatar_storage')), $fileName, $cropData);
    }

    //===================================================================
    // Vendor Functions
    //===================================================================

    public function uploadVendorAsset(UploadedFile $file, $fileName = null)
    {
        if(!isset($fileName))
        {
            $fileName = $this->generateUniqueFilename($file->getClientOriginalExtension());
        }

        $this->uploadFile($file, $fileName, public_path(config('app.vendor_storage')));

        return $fileName;
    }

    public function removeVendorAsset($file)
    {
        try
        {
            Storage::disk('vendors')->delete($file);
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function resizeVendorAsset($fileName, $width, $height)
    {
        $this->resizeImage(public_path(config('app.vendor_storage')), $fileName, $width, $height);
    }

    //===================================================================
    // General Functions
    //===================================================================

    public function generateUniqueFilename($extension)
    {
        return Uuid::uuid4()->toString() . "." . $extension;
    }

    public function uploadFile(UploadedFile $file, $fileName, $path)
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

    public function cropImage($path, $fileName, $cropData)
    {
        // $cropData is an array with the following order:
        // width, height, x, y, rotate, scaleX, scaleY

        $img = Image::make($path . '/' .  $fileName)->crop(ceil($cropData[0]), ceil($cropData[1]), ceil($cropData[2]), ceil($cropData[3]));
        $img->save();
    }

    public function resizeImage($path, $fileName, $width, $height)
    {
        $img = Image::make($path . '/' . $fileName)->resize($width, $height);
        $img->save();
    }

    public function getRemoteFile($url, $fileName, $path, $resizeWidth = null, $resizeHeight = null)
    {
        $extension = pathinfo($url, PATHINFO_EXTENSION);
        $fileName = $fileName . '.' . $extension;
        $savePath = $path . '/' . $fileName;

        $file = file_get_contents($url);

        $saved = file_put_contents($savePath, $file);

        $success = false;

        if($saved)
        {
            $success = true;

            if(isset($resizeWidth) && isset($resizeHeight))
            {
                $this->resizeVendorAsset($fileName, $resizeWidth, $resizeHeight);
            }
        }

        return $success;
    }
}