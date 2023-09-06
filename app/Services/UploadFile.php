<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadFile
{
    public static function saveImage($file, $folder = 'images')
    {
        $path = Storage::disk('s3')->put($folder, $file, 'public');
        $url = Storage::disk('s3')->url($path);
        return $path;
    }

    public static function removeImage($imagePath)
    {
        Storage::disk('s3')->delete($imagePath);
        
        if (Storage::disk('s3')->missing($imagePath)) {
            return true;
        } else {
            return false;
        }
    }
}
