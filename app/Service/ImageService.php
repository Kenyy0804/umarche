<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image; // 修正

class ImageService
{
    public static function upload($imageFile, $folderName)
    {
        // $fileName = uniqid(rand() . '_');
        // $extension = $imageFile->extension();
        // $fileNameToStore = $fileName . '.' . $extension;

        // // 画像をリサイズ
        // $resizedImage = Image::make($imageFile)->resize(1920, 1080)->encode($extension);

        // // ストレージに保存
        // Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage);

        // return $fileNameToStore;
    }
}
