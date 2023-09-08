<?php
namespace App\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UploadFile
{
    public static function saveImage($file, $folder = 'images')
    {
        $path = Storage::disk('s3')->put($folder, $file, 'public');     //path
        $url = Storage::disk('s3')->url($folder);                       //full url
        return [$path, $url];
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

    public static function moveImagesToCloud($paths, $folder = 'images')
    {
        if (!empty($paths)) {
            $pathsArr = [];
            $imagePaths = Session::get('uploaded_files', []);
            foreach($paths as $key => $path) {
                $file = Storage::get($path);
                $fileName = basename($path);
                list($isUpload, $cloudUrl) = self::saveImage($file, $folder.'/'.$fileName);
                $pathsArr[] = $cloudUrl;
            }
            foreach($imagePaths as $img) {
                Storage::delete($img);
            }
            Session::forget('uploaded_files');
            return $pathsArr;
        }
    }
}
