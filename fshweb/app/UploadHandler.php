<?php
/**
 * Created by PhpStorm.
 * User: Breen
 * Date: 26/11/2015
 * Time: 12:16 AM
 */

namespace App;

use Ramsey\Uuid\Uuid;

class UploadHandlerLocal
{
    public function generateUniqueFilename($extension)
    {
        return Uuid::uuid4()->toString() . "." . $extension;
    }

    public function uploadAvatar($file, $avatarFilename = null)
    {
        if(!isset($avatarFilename))
        {
            $avatarFilename = generateUniqueFilename($file->getClientOriginalExtension());
        }

        $this->uploadFile($file, $avatarFilename, public_path(config('app.avatar_storage')));

        return $avatarFilename;
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