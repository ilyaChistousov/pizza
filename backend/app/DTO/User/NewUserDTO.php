<?php

namespace App\DTO\User;

use Spatie\LaravelData\Data;

class NewUserDTO extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly string $phone
    )
    {}
}
