<?php

namespace alcamo\collection;

use PHPUnit\Framework\TestCase;

class SerializableReadonlyCollectionTest extends TestCase
{
    /**
     * @dataProvider serializeProvider
     */
    public function testSerialize($text): void
    {
        $collection = SerializableReadonlyCollection::newFromString($text);

        $this->assertSame($text, (string)$collection);
    }

    public function serializeProvider(): array
    {
        return [
            [ 'foo=Foo,bar=bar\,BAR,baz=baz\0ABAZ' ]
        ];
    }
}
