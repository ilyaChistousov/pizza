<?php

namespace App\DTO\User;

use App\Enums\UserRole;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

class GetUserDTO extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly UserRole $role,
        #[MapName('created_at')]
        public readonly string $createdAt,
        #[MapInputName('ordersInfo')]
        public readonly array $orders
    )
    {}
}
