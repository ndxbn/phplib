<?php

namespace Ndxbn\Lib\Collection;

use PHPUnit\Framework\TestCase;

class ObjectSetTest extends TestCase
{
    public function testUseCase()
    {
        $target = new ObjectSet();

        $o1 = new \stdClass();
        $o2 = new \stdClass();
        $o3 = new \stdClass();

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
}
