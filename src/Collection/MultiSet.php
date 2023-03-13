<?php

namespace Ndxbn\Lib\Collection;

/**
 *
 * @template T of string|int|float
 * @implements ISet<T>
 * @implements \IteratorAggregate<int, T>
 */
class MultiSet implements ISet, \IteratorAggregate
{
    /**
     * @var int<0, max> total count
     */
    private int $counter = 0;

    /**
     * @var array<string, int<0, max>> key is serialized item, value is count
     */
    private array $container = [];

    private function generateKey(mixed $item): string
    {
        return serialize($item);
    }

    public function has(mixed $item): bool
    {
        $key = $this->generateKey($item);

        return array_key_exists($key, $this->container) && ($this->container[$key] > 0);
    }

    public function remove(mixed $item): bool
    {
        $key = $this->generateKey($item);

        if (!array_key_exists($key, $this->container)) {
            return false;
        }

        // before decrement, counter must be greater than 0.
        assert($this->counter > 0);
        assert($this->container[$key] > 0);

        $this->counter--;
        $this->container[$key]--;
        if ($this->container[$key] === 0) {
            unset($this->container[$key]);
        }

        return true;
    }

    public function isEmpty(): bool
    {
        return 0 === $this->counter && assert($this->container === []);
    }

    public function clear(): void
    {
        $this->counter = 0;
        $this->container = [];
    }

    public function add(mixed $item): void
    {
        $key = $this->generateKey($item);

        $this->counter++;
        if (array_key_exists($key, $this->container)) {
            $this->container[$key]++;
        } else {
            $this->container[$key] = 1;
        }
    }

    public function count(): int
    {
        return $this->counter;
    }

    public function getIterator(): \Generator
    {
        foreach ($this->container as $key => $count) {
            $item = unserialize($key);
            for ($i = 0; $i < $count; $i++) {
                yield $item;
            }
        }
    }
}
