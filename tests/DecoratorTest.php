<?php

namespace alcamo\collection;

use Ds\Set;
use PHPUnit\Framework\TestCase;

class MyDecoratorCollection extends ReadonlyPrefixSet
{
    use DecoratorTrait;
}

class DecoratorTest extends TestCase
{
    public function testDecorator()
    {
        $collection = new MyDecoratorCollection(new Set([ 'foo', 'bar' ]));

        $this->assertSame('foo,bar', $collection->join(','));
    }
}
