<?php

namespace App\Services\Product\DTO;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class GetProductDTO extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $slug,
        #[MapInputName('categoryName')]
        public readonly string $category,
        public readonly string $description,
        public readonly string $image,
        public readonly array|null $price
    )
    {}
}
