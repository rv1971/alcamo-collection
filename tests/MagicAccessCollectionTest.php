<?php

namespace alcamo\collection;

use PHPUnit\Framework\TestCase;

class MagicAccessCollectionTest extends TestCase
{
    /**
     * @dataProvider basicsProvider
     */
    public function testBasics(?array $data): void
    {
        /* test ArrayDataTrait */
        $collection = new MagicAccessCollection($data);

        /* test CountableTrait */
        $this->assertSame(count($data ?? []), count($collection));

        /* test ArrayIteratorTrait */
        if (isset($data)) {
            $collection2 = new MagicAccessCollection();

            foreach ($collection as $key => $value) {
                $collection2->$key = $value;
            }

            $this->assertEquals($collection, $collection2);

            $this->assertSame(reset($data), $collection->first());
            $this->assertSame(end($data), $collection->last());
        } else {
            $this->assertNull($collection->first());
            $this->assertNull($collection->last());
        }

        /* test ReadMagicAccessTrait */
        $this->assertFalse(isset($collection->fooo));
        $this->assertNull($collection->baar);

        /* test WriteMagicAccessTrait */
        $collection->corge = 'CORGE';

        $this->assertSame('CORGE', $collection->corge);
        $this->assertSame(count($data ?? []) + 1, count($collection));

        if (isset($data)) {
            $key = array_keys($data)[2];

            unset($collection->$key);

            $this->assertFalse(isset($collection->$key));
            $this->assertSame(count($data), count($collection));
        }
    }

    public function basicsProvider(): array
    {
        return [
            [ null ],
            [ [ 'foo', 'bar', 'baz' ] ],
            [ [ 'f' => 'foo', 'b' => 'bar', 'z' => 'baz', 'x' => 'qux' ] ]
        ];
    }
}
