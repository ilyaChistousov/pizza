<?php

namespace App\DTO\Order;

use App\Enums\OrderStatus;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class NewOrderDTO extends Data
{
    public function __construct(
        #[MapInputName('user_id')]
        #[MapName('user_id')]
        public readonly int|Optional $userId,
        public readonly int $total,
        public readonly string|Optional $email,
        public readonly string $phone,
        public readonly string $address,
        public readonly array $products
    )
    {}
}
