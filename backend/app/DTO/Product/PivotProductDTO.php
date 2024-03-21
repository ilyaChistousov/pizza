<?php

namespace App\DTO\Product;

use App\Enums\ProductSize;
use Spatie\LaravelData\Data;

class PivotProductDTO extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $image,
        public readonly int $price,
        public readonly int $quantity,
        public readonly ProductSize $size
    )
    {}
}
