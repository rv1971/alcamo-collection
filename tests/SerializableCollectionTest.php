<?php

namespace alcamo\collection;

use PHPUnit\Framework\TestCase;

class SerializableCollectionTest extends TestCase
{
    /**
     * @dataProvider serializeProvider
     */
    public function testSerialize($text): void
    {
        $collection = SerializableCollection::newFromString($text);

        $this->assertSame($text, (string)$collection);
    }

    public function serializeProvider(): array
    {
        return [
            [ 'foo=Foo,bar=bar\,BAR,baz=baz\0ABAZ' ]
        ];
    }
}
