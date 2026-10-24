<?php

namespace alcamo\collection;

use alcamo\exception\SyntaxError;
use PHPUnit\Framework\TestCase;

class Rfc4514SerializerTest extends TestCase
{
    /**
     * @dataProvider serializeProvider
     */
    public function testSerialize($data, $expectedSerialization): void
    {
        $serializer = new Rfc4514Serializer();

        $this->assertSame(
            $expectedSerialization,
            $serializer->serialize($data)
        );

        $this->assertSame(
            $data,
            $serializer->deserialize($expectedSerialization)
        );
    }

    public function serializeProvider(): array
    {
        /*
        $serializer = new Rfc4514Serializer();

        $text = 'foo=FOO\\\\\\+\\\\01,bar=42,'
                . 'baz=Lorem\\ ipsum\\,\\0Adolor\+sit\09amet\;,'
            . 'qux=\\,Q\\,\\=\\,U\\=X\\,,quux=';

        for ($i = 0; $i < 1000000; $i++) {
            $serializer->deserialize($text);
        }

        exit;
        */

        return [
            [ [], '' ],
            [
                [
                    'foo' => 'FOO\\+\\01',
                    'bar' => '42',
                    'baz' => "Lorem ipsum,\ndolor+sit\tamet;",
                    'qux' => ',Q,=,U=X,',
                    'quux' => ''
                ],
                'foo=FOO\\\\\\+\\\\01,bar=42,'
                . 'baz=Lorem\\ ipsum\\,\\0Adolor\+sit\09amet\;,'
                . 'qux=\\,Q\\,\\=\\,U\\=X\\,,quux='
            ],
            [
                /* This test succeeds thanks to the lookbehind assertion in
                 * Rfc4514Serializer::ODD_LENGTH_BACKSLASH_SEQUENCE_REGEXP. */
                [
                    'corge1' => "\\\x01",
                    'corge2' => "\\\\0A",
                    'corge3' => "\\\\\\\\0B"
                ],
                'corge1=\\\\\\01,corge2=\\\\\\\\0A,corge3=\\\\\\\\\\\\\\\\0B'
            ]
        ];
    }

    public function testSerializeExcpeption(): void
    {
        $serializer = new Rfc4514Serializer();

        $this->expectException(SyntaxError::class);

        $this->expectExceptionMessage(
            'Syntax error for key "foo.bar"; not a valid RFC 4512 keystring'
        );

        $serializer->serialize([ 'foo.bar' => 42 ]);
    }

    public function testDeserialize(): void
    {
        $collection = new Collection([ 'foo' => 42 ]);

        $serializer = new Rfc4514Serializer();

        $serializer->deserialize('bar=43,qux=Q', $collection);

        $this->assertEquals(
            new Collection([ 'foo' => 42, 'bar' => '43', 'qux' => 'Q' ]),
            $collection
        );
    }

    public function testDeserializeException1(): void
    {
        $serializer = new Rfc4514Serializer();

        $this->expectException(SyntaxError::class);

        $this->expectExceptionMessage(
            'Syntax error in "foo=bar," at offset 8 (""); '
                . 'not valid RFC 4514 syntax'
        );

        $serializer->deserialize('foo=bar,');
    }

    public function testDeserializeException2(): void
    {
        $serializer = new Rfc4514Serializer();

        $this->expectException(SyntaxError::class);

        $this->expectExceptionMessage(
            'Syntax error in "ba\\.r" for key "foo"; '
                . 'not valid RFC 4514 syntax'
        );

        $serializer->deserialize('foo=ba\\.r');
    }

    public function testDeserializeException3(): void
    {
        /* This test succeeds thanks to the lookbehind assertion in
         * Rfc4514Serializer::ODD_LENGTH_BACKSLASH_SEQUENCE_REGEXP. */

        $serializer = new Rfc4514Serializer();

        $this->expectException(SyntaxError::class);

        $this->expectExceptionMessage(
            'Syntax error in "ba\\\\\\.r" for key "foo"; '
                . 'not valid RFC 4514 syntax'
        );

        $serializer->deserialize('foo=ba\\\\\\.r');
    }
}
