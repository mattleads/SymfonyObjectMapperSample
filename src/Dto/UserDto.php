<?php

namespace App\Dto;

final readonly class UserDto
{
    public function __construct(
        public int $id,
        public string $email,
        public bool $isActive,
    ) {}
}
