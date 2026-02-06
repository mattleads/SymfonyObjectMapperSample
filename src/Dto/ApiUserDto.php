<?php

namespace App\Dto;

use Symfony\Component\ObjectMapper\Attribute\Map;

final readonly class ApiUserDto
{
    public function __construct(
        #[Map(source: 'user_id')]
        public int $userId,
        #[Map(source: 'first_name')]
        public string $firstName,
        #[Map(source: 'last_name')]
        public string $lastName,
    ) {}
}
