<?php

namespace App\DTO\Order;

use App\Enums\OrderStatus;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class DetailedOrderDTO extends Data
{
    public function __construct(
        public readonly int $id,
        #[MapInputName('created_at')]
        public readonly string $createdAt,
        #[MapInputName('updated_at')]
        public readonly string $updatedAt,
        public readonly int|null $userId,
        public readonly int $total,
        public readonly string|null $email,
        public readonly string $phone,
        public readonly string $address,
        #[MapInputName('orderProducts')]
        public readonly array $products,
        public readonly OrderStatus $status
    )
    {}
}
