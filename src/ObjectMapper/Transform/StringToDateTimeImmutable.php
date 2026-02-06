<?php

namespace App\ObjectMapper\Transform;

use Symfony\Component\ObjectMapper\TransformCallableInterface;

final readonly class StringToDateTimeImmutable implements TransformCallableInterface
{
    public function __construct(
        private string $format = \DateTimeInterface::RFC3339,
    ) {}

    public function __invoke(mixed $value, object $source, ?object $target): \DateTimeImmutable
    {
        $date = \DateTimeImmutable::createFromFormat($this->format, $value);

        if ($date === false) {
            throw new \InvalidArgumentException(
                sprintf('Cannot parse date "%s" with format "%s".', $value, $this->format)
            );
        }

        return $date;
    }
}
