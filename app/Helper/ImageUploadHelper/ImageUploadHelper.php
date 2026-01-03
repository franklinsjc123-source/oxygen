<?php

namespace App\Helper\ImageUploadHelper;


class ImageUploadHelper
{

    public static function storeImage($file, string $path)
    {

        $imageName = time() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path($path);
        $file->move($destinationPath, $imageName);
        $file->imagePath = $destinationPath . $imageName;

        return $imageName;
    }
}