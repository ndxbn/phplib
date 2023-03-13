<?php

namespace Ndxbn\Lib\Collection;

/**
 * @template T of object
 * @implements ISet<T>
 * @extends \SplObjectStorage<T, void>
 */
class ObjectSet extends \SplObjectStorage implements ISet
{
    public function remove(mixed $item): bool
    {
        $returnValue = $this->contains($item); // `contains()` is native `has()`,
        $this->detach($item);

        return $returnValue;
    }

    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }

    public function clear(): void
    {
        $this->removeAll($this);
    }

    public function add(mixed $item): void
    {
        $this->attach($item);
    }

    public function has(mixed $item): bool
    {
        return $this->contains($item);
    }
}
