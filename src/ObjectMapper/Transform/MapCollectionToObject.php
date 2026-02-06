<?php

namespace App\ObjectMapper\Transform;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\ObjectMapper\Exception\MappingException;
use Symfony\Component\ObjectMapper\ObjectMapperInterface;
use Symfony\Component\ObjectMapper\TransformCallableInterface;

final readonly class MapCollectionToObject implements TransformCallableInterface
{
    public function __construct(
        #[Autowire(service: 'object_mapper')]
        private ObjectMapperInterface $objectMapper,
        private string $targetClass,
    ) {
    }
    public function __invoke(mixed $value, object $source, ?object $target): mixed
    {
        if (!is_iterable($value)) {
            throw new MappingException(\sprintf('The MapCollection transform expects an iterable, "%s" given.', get_debug_type($value)));
        }

        $values = [];
        foreach ($value as $k => $v) {
            if (\is_object($v)) {
                $values[$k] = $this->objectMapper->map($v, $this->targetClass);
            } else {
                $values[$k] = $this->objectMapper->map((object)$v, $this->targetClass);
            }
        }
        return $values;
    }
}
