<?php

namespace App\Helper\ImageUploadHelper;


class ImageUploadHelper
{

    public static function storeImage($file, string $path)
    {
        if (empty($file) || !is_object($file) || !method_exists($file, 'getClientOriginalExtension')) {
            return '';
        }

        $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path($path);
        $file->move($destinationPath, $imageName);
        $file->imagePath = $destinationPath . $imageName;

        return $imageName;
    }
}