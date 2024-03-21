<?php

namespace App\DTO\Order;

use App\Enums\OrderStatus;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class OrderDTO extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly int $total,
        public readonly string $address,
        public readonly OrderStatus $status,
        #[MapName('created_at')]
        public readonly string $createdAt
    )
    {}
}
