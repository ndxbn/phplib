<?php

namespace Ndxbn\Lib\Collection;

/**
 * @template TKey
 * @template TValue
 * @extends \Traversable<TKey, TValue>
 */
interface ICollection extends \Countable, \Traversable
{

    /**
     * @inheritDoc
     */
    public function count(): int;

    /**
     * add an item.
     * @param TValue $item
     * @return void
     */
    public function add(mixed $item): void;

    /**
     * remove all items.
     * @return void
     */
    public function clear(): void;

    /**
     *  if contains item, it's true.
     * @param TValue $item
     * @return bool
     */
    public function has(mixed $item): bool;

    /**
     * remove an item. if removed, it true.
     * @param TValue $item
     * @return bool
     */
    public function remove(mixed $item): bool;
}
