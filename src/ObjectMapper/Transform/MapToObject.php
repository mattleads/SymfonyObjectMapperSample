<?php

namespace App\ObjectMapper\Transform;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\ObjectMapper\ObjectMapperInterface;
use Symfony\Component\ObjectMapper\TransformCallableInterface;

final readonly class MapToObject implements TransformCallableInterface
{
    public function __construct(
        #[Autowire(service: 'object_mapper')]
        private ObjectMapperInterface $objectMapper,
        private string $targetClass,
    ) {}

    public function __invoke(mixed $value, object $source, ?object $target = null): mixed
    {

        if (!\is_array($value) && !\is_object($value)) {
            throw new \InvalidArgumentException(\sprintf('Expected an array or object, got "%s".', get_debug_type($value)));
        }

        if (\is_object($value)) {
            return $this->objectMapper->map($value, $this->targetClass);
        }

        return $this->objectMapper->map((object) $value, $this->targetClass);
    }
}
