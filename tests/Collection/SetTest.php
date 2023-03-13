<?php

namespace Ndxbn\Lib\Collection;

use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function testUseCase() {

        $target = new Set();

        $o1 = "I am elePHPant";
        $o2 = ["a" => "A", "b" => ["twice" => "BB", 99 => "BB"]];
        $o3 = 3.16;

        self::assertTrue($target->isEmpty());

        // only $o1
        $target->add($o1);
        // empty and count method
        self::assertFalse($target->isEmpty());
        self::assertSame(1, $target->count());
        // has method
        self::assertTrue($target->has($o1));
        self::assertFalse($target->has($o2));

        // add $o2
        $target->add($o2);
        // count method
        self::assertSame(2, $target->count());
        // has method
        self::assertTrue($target->has($o1));
        self::assertTrue($target->has($o2));

        // add $3
        $target->add($o3);
        // count method
        self::assertSame(3, $target->count());

        // remove $o2
        $target->remove($o2);
        // count method
        self::assertSame(2, $target->count());
        // has method
        self::assertTrue($target->has($o1));
        self::assertFalse($target->has($o2));
        self::assertTrue($target->has($o3));

        // clear all
        $target->clear();
        // empty and count method
        self::assertSame(0, $target->count());
        self::assertTrue($target->isEmpty());
        // has method
        self::assertFalse($target->has($o1));
        self::assertFalse($target->has($o3));
    }

    public function test_getIterator() {
        $target = new Set();

        $o1 = "I am elePHPant";
        $o2 = ["a" => "A", "b" => ["twice" => "BB", 99 => "BB"]];
        $o3 = 3.16;

        $target->addAll([$o1, $o2, $o3]);

        // count method
        self::assertSame(3, $target->count());
        // has method
        self::assertTrue($target->has($o1));
        self::assertTrue($target->has($o2));
        self::assertTrue($target->has($o3));

        // let's test
        $expect = [$o1, $o2, $o3];
        $result = [];

        foreach ($target->getIterator() as $item) {
            $result[] = $item;
        }
        self::assertSame($expect, $result);
    }
}
