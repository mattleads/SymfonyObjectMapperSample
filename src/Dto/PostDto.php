<?php

namespace App\Dto;

final readonly class PostDto
{
    public function __construct(
        public int $postId,
        public string $title
    ) {}
}
