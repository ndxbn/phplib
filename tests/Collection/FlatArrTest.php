<?php

namespace Ndxbn\Lib\Collection;

use PHPUnit\Framework\TestCase;

class FlatArrTest extends TestCase
{
    public function testArray_dot(): void
    {
        $target = ["a" => "A", "b" => "B", "c" => ["cc" => "CC", "ccc" => "CCC"]];
        $expect = ["a" => "A", "b" => "B", "c.cc" => "CC", "c.ccc" => "CCC"];

        static::markTestIncomplete();
    }

    public function testArray_dot_includes_empty_array(): void
    {
        $target = ["a" => [], "b" => ["c" => []]];
        $expect = ["a" => [], "b.c" => []];

        static::markTestIncomplete();
    }

}
