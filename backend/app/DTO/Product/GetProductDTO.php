<?php

namespace App\DTO\Product;

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
        public readonly array $price
    )
    {}
}
