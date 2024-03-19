<?php

namespace App\DTO\Product;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class NewProductDTO extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $category,
        public readonly string $description,
        public readonly UploadedFile $image,
        public readonly array $price
    ) {
    }
}
