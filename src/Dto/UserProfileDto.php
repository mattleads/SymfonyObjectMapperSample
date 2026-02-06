<?php

namespace App\Dto;

use Symfony\Component\ObjectMapper\Attribute\Map;

final readonly class UserProfileDto
{
    public function __construct(
        public int $userId,
        public string $username,
        #[Map(transform: ['app.transform.map_to_address'])]
        public AddressDto $shippingAddress,
        #[Map(transform: [' app.transform.map_to_post_collection'])]
        public array $posts,
    ) {}
}
