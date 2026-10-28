<?php

namespace alcamo\collection;

use PHPUnit\Framework\TestCase;

class SplObjectStorageCollectionTest extends TestCase
{
    private $foo;
    private $bar;
    private $baz;
    private $qux;

    private $fooo;
    private $baar;

    private $corge;

    public function setUp(): void
    {
        foreach (
            ['foo', 'bar', 'baz', 'qux', 'fooo', 'baar', 'corge'] as $id
        ) {
            $this->$id = (object)[ 'id' => $id ];
        }
    }

    /**
     * @dataProvider basicsProvider
     */
    public function testBasics(?\SplObjectStorage $data): void
    {
        if (isset($data)) {
            foreach (['foo', 'bar', 'baz', 'qux'] as $id) {
                $data[$this->$id] = $id;
            }
        }

        /* test SplObjectStorageDataTrait */
        $collection = new SplObjectStorageCollection(
            isset($data) ? clone $data : null
        );

        /* test CountableTrait */
        $this->assertSame(count($data ?? []), count($collection));

        /* test SplObjectStorageIteratorTrait */
        if (isset($data)) {
            $data2 = new \SplObjectStorage();

            foreach ($collection as $key => $value) {
                $data2[$key] = $value;
            }

            $this->assertEquals($data, $data2);
        }

        /* test ReadArrayAccessTrait */
        $this->assertFalse(isset($collection[$this->fooo]));
        $this->assertNull($collection[$this->baar]);

        if (isset($data)) {
            $this->assertTrue(isset($collection[$this->foo]));
            $this->assertSame($data[$this->foo], $collection[$this->foo]);
        }

        /* test WriteArrayAccessTrait */
        $collection[$this->corge] = 'CORGE';

        $this->assertSame('CORGE', $collection[$this->corge]);
        $this->assertSame(count($data ?? []) + 1, count($collection));

        if (isset($data)) {
            unset($collection[$this->baz]);

            $this->assertFalse(isset($collection[$this->baz]));
            $this->assertSame(count($data), count($collection));
        }
    }

    public function basicsProvider(): array
    {
        $data1 = new \SplObjectStorage();

        return [
            [ null ],
            [ $data1 ]
        ];
    }

    public function testClone(): void
    {
        $collection1 = new SplObjectStorageCollection();

        $collection1[$this->foo] = 'foo';

        $this->assertSame(1, count($collection1));

        $collection2 = clone $collection1;

        $collection2[$this->bar] = 'bar';

        $this->assertSame(2, count($collection2));

        $this->assertSame(1, count($collection1));
    }
}
