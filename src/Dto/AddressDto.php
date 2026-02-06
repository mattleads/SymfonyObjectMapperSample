<?php

namespace App\Dto;

final readonly class AddressDto
{
    public function __construct(
        public string $street,
        public string $city
    ) {}
}
