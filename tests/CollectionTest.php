<?php

namespace alcamo\collection;

use PHPUnit\Framework\TestCase;

class MyString
{
    private $string_;

    public function __construct(string $string)
    {
        $this->string_ = $string;
    }

    public function __toString(): string
    {
        return $this->string_;
    }
}

class CollectionTest extends TestCase
{
    /**
     * @dataProvider basicsProvider
     */
    public function testBasics(?array $data): void
    {
        /* test ArrayDataTrait */
        $collection = new Collection($data);

        /* test CountableTrait */
        $this->assertSame(count($data ?? []), count($collection));

        /* test ArrayIteratorTrait */
        if (isset($data)) {
            $data2 = [];

            foreach ($collection as $key => $value) {
                $data2[$key] = $value;
            }

            $this->assertSame($data, $data2);

            $this->assertSame(reset($data), $collection->first());
            $this->assertSame(end($data), $collection->last());
            $this->assertSame(array_keys($data), $collection->getKeys());
        } else {
            $this->assertNull($collection->first());
            $this->assertNull($collection->last());
            $this->assertSame([], $collection->getKeys());
        }

        /* test StringIndexedReadArrayAccessTrait */
        $this->assertFalse(isset($collection['fooo']));
        $this->assertNull($collection['baar']);

        if (isset($data)) {
            $key = array_keys($data)[1];

            $this->assertTrue(isset($collection[new MyString($key)]));
            $this->assertSame($data[$key], $collection[new MyString($key)]);
        }

        /* test ContainsTrait */
        $this->assertFalse($collection->contains('bazz'));

        if (isset($data)) {
            foreach ($data as $value) {
                $this->assertTrue($collection->contains($value));
            }
        }

        /* test StringIndexedWriteArrayAccessTrait */
        $collection[new MyString('corge')] = 'CORGE';

        $this->assertSame('CORGE', $collection['corge']);
        $this->assertSame(count($data ?? []) + 1, count($collection));

        if (isset($data)) {
            $key = array_keys($data)[2];

            unset($collection[new MyString($key)]);

            $this->assertFalse(isset($collection[$key]));
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

    public function testAdd(): void
    {
        $collection = new Collection([ 'foo' => 'F', 'bar' => 'B' ]);

        $collection
            ->add([ 'baz' => 'Z' ])
            ->add(new Collection([ 'qux' => 'Q', 'bar' => 'R' ]));

        $this->assertSame(
            [ 'foo', 'bar', 'baz', 'qux' ],
            $collection->getKeys()
        );

        foreach (
            [
                'foo' => 'F',
                'bar' => 'B',
                'baz' => 'Z',
                'qux' => 'Q'
            ] as $key => $expectedValue
        ) {
            $this->assertSame($expectedValue, $collection[$key]);
        }
    }
}
