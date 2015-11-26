<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 26/11/2015
 * Time: 12:16 AM
 */

namespace App;

use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class UploadHandler
{
    public function generateUniqueFilename($extension)
    {
        return Uuid::uuid4()->toString() . "." . $extension;
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
}