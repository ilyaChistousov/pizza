<?php

namespace App\Services\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function savePublicly(UploadedFile $image, string $path = 'public/images/products'): string
    {
        $imagePath = $image->storePublicly($path);
        return config('app.url') . Storage::url($imagePath);
    }

    public function saveTestImage(
        string $pathToImage = 'tests/storage/images/Peperonni.jpg',
        string $storagePath = 'public/images/products'): string
    {
        $fileName = basename($pathToImage);
        $destinationPath = $storagePath . '/' . $fileName;
        Storage::put($destinationPath, file_get_contents( base_path() . '/' . $pathToImage));
        return config('app.url') . Storage::url($destinationPath);
    }
}
