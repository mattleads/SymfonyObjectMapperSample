<?php

namespace App\Dto;

use App\ObjectMapper\Transform\StringToDateTimeImmutable;
use Symfony\Component\ObjectMapper\Attribute\Map;

final readonly class EventDto
{
    public function __construct(
        public string $name,
        #[Map(source: 'startTime', transform: new StringToDateTimeImmutable('Y-m-d\TH:i:sP'))]
        public \DateTimeImmutable $startTime
    ) {}
}
