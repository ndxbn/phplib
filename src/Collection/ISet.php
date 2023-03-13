<?php

namespace Ndxbn\Lib\Collection;

/**
 * @template T
 * @extends ICollection<int, T>
 *     key is not `int<0, max>`, it might be minus when seek to prev.
 */
interface ISet extends ICollection
{

    public function has(mixed $item): bool;

    public function remove(mixed $item): bool;

    public function isEmpty(): bool;

    public function clear(): void;

    public function add(mixed $item): void;

    public function count(): int;
}
