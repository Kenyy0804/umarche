<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image; // 修正

class ImageService
{
    public static function upload($imageFile, $folderName)
    {
        if(is_array($imageFile))
        {
            $file = $imageFile['image'];
        } else {
            $file = $imageFile;
        }
            $fileName = uniqid(rand() . '_'); //ランダムでファイル名を作成し、_を付ける。
            $extension = $file->extension(); // 拡張子を取得
            $fileNameToStore = $fileName . '.' . $extension; // 作ったファイル名と拡張子を変数になおす。
            $resizedImage = Image::make($file)->resize(1920, 1080)->encode();

            Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage);

            return $fileNameToStore;
    }
}