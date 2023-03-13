<?php

namespace Ndxbn\Lib\Collection;

use Traversable;

/**
 * "Set" Type, one of Collection Types, for only string, int, float, array.
 *
 * If you want to use Object, Array and more another types:
 *   - use Ndxbn\Lib\Collection\ObjectSet class, which can contain Object.
 *   - convert to string by serialize() or json_encode().
 *
 * @template T of string|int|float
 * @implements ISet<T>
 * @implements \IteratorAggregate<int, T>
 */
class Set implements ISet, \IteratorAggregate
{
    /**
     * @var array<string, true>
     */
    private array $container = [];

    /**
     * @param T $item
     * @return string
     */
    private static function generateKey(mixed $item): string
    {
        return serialize($item);
    }

    public function isEmpty(): bool
    {
        return [] === $this->container;
    }

    public function add(mixed $item): void
    {
        $key = Set::generateKey($item);
        $this->container[$key] = true;
    }

    /**
     * @param T[] $items
     * @return void
     */
    public function addAll(array $items): void
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    public function has(mixed $item): bool
    {
        $key = Set::generateKey($item);
        return array_key_exists($key, $this->container);
    }

    public function remove(mixed $item): bool
    {
        $key = Set::generateKey($item);
        $returnValue = $this->has($key);
        unset($this->container[$key]);

        return $returnValue;
    }

    public function clear(): void
    {
        $this->container = [];
    }

    public function getIterator(): \Generator
    {
        foreach (array_keys($this->container) as $key) {
            /** @var T $item */
            $item = unserialize($key);

            yield $item;
        }
    }

    public function count(): int
    {
        return count($this->container);
    }
}
