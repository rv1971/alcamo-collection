<?php

namespace alcamo\collection;

use Ds\Set;
use PHPUnit\Framework\TestCase;

class SetCollectionTest extends TestCase
{
    /**
     * @dataProvider basicsProvider
     */
    public function testBasics(?Set $data): void
    {
        /* test SetDataTrait */
        $collection = new SetCollection($data);

        /* test CountableTrait */
        $this->assertSame(count($data ?? []), count($collection));

        /* test SetIteratorTrait */
        if (isset($data)) {
            $data2 = new Set();

            foreach ($collection as $key => $value) {
                $data2->add($value);
            }

            $this->assertEquals($data, $data2);
        }
    }

    public function basicsProvider(): array
    {
        return [
            [ null ],
            [ new Set([ 'foo', 'bar', 'baz']) ]
        ];
    }
}
