<?php

namespace alcamo\collection;

use PHPUnit\Framework\TestCase;

class MyCollection extends Collection
{
    use CloneArrayTrait;
}

class CloneArrayTest extends TestCase
{
    public function testBasics()
    {
        $collection1 = new MyCollection();
        $collection1[0] = (object)[ 'bar' => 'baz' ];

        $collection2 = clone $collection1;

        $collection2[0]->bar = 'qux';

        $this->assertSame('baz', $collection1[0]->bar);

        $this->assertSame('qux', $collection2[0]->bar);
    }
}
