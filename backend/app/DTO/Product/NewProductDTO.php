<?php

namespace App\DTO\Product;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class NewProductDTO extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $category,
        public readonly string $description,
        public readonly UploadedFile|Optional $image,
        public readonly array $price
    ) {
    }
}
