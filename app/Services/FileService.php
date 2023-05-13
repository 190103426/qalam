<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{

    public static function deleteFile($name, $path)
    {
        if ($name && Storage::disk('public')->exists($path . '/' . $name)) {
            Storage::disk('public')->delete($path);
        }
        return null;
    }


    public static function saveFile($file, $path, $oldFileName = null)
    {
        if ($oldFileName) {
            FileService::deleteFile($oldFileName, $path);
        }
        $fileName = $file->getClientOriginalName();


        if (Storage::disk('public')->exists($path . "/$fileName")) {
            $fileName = explode('.', $fileName);
            $extension = array_pop($fileName);
            $fileName = join('', $fileName) . "_" . rand(1, 99) . ".$extension";
        }
        Storage::disk('public')->putFileAs($path, $file, $fileName);
        return $fileName;
    }
}
