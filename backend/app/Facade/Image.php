<?php

namespace App\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static savePublicly(\Illuminate\Http\UploadedFile $image, string $path = 'public/images/products')
 * @method static saveTestImage(string $pathToImage = 'tests/storage/test.jpg', string $path = 'public/images/products')
 */
class Image extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'image';
    }

}
