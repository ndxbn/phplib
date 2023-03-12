<?php
namespace Ndxbn\Lib\Collection;

/**
 * This class likes Native Array, but max depth is 1.
 *
 * make new FlatArr instance from
 * `["a" => "A", "b" => "B", "c" => ["cc" => "CC", "ccc" => "CCC"]]`
 * it will be
 * `["a" => "A", "b" => "B", "c.cc" => "CC", "c.ccc" => "CCC"]`
 *
 */
class FlatArr implements \ArrayAccess, \IteratorAggregate, \Countable, \JsonSerializable
{
    /**
     * @var array<string, mixed>
     */
    private array $container = [];

    public function __construct()
    {
    }

    /**
     * @param array<mixed> $target
     * @param string $prepend
     * @return array<mixed>
     */
    public static function dot(array $target, string $prepend = ''): array
    {
        $result = [];

        foreach ($target as $key => $item) {
            if (!is_array($item)) {
                // 普通はそのまま
                $result[$prepend . $key] = $item;
            } elseif ($item === []) {
                // 配列だとしても、空ならそのまま。
                $result[$prepend . $key] = $item;
            } else {
                $result = [...$result, ...static::dot($item, "{$key}.")];
            }
        }

        return $result;
    }

    /**
     * @param array<string, mixed> $target
     * @return array<mixed>
     */
    public static function undot(array $target): array
    {
        $result = [];

        foreach ($target as $keyWithDot => $item) {
            /**
             * @var string[] e.g.: "a.b.c" -> ["c", "b", "a"]
             */
            $keys = array_reverse(explode('.', $keyWithDot));

            foreach ($keys as $key) {

            }
        }
    }

    // ArrayAccess
    public function offsetExists(mixed $offset): bool
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet(mixed $offset): mixed
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->container[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    // Countable
    public function count(): int
    {
        return \count($this->container);
    }

    // IteratorAggregate, Traversable
    public function getIterator(): \Traversable
    {
        foreach ($this->container as $key => $value) {
            yield $key => $value;
        }
    }

    // JsonSerializable

    /**
     * @return Array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->container;
    }
}
