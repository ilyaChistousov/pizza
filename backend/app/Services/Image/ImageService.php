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
}
