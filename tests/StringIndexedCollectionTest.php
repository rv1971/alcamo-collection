<?php

namespace alcamo\collection;

use PHPUnit\Framework\TestCase;

class MyString
{
    private $text_;

    public function __construct(string $text)
    {
        $this->text_ = $text;
    }

    public function __toString(): string
    {
        return $this->text_;
    }
}

class StringIndexedCollectionTest extends TestCase
{
    public function testBasics()
    {
        $data = [ 'f' => 'foo', 'b' => 'bar', 'z' => 'baz' ];

        $a = new StringIndexedCollection($data);

        $this->assertTrue(isset($a[new MyString('f')]));

        $this->assertSame('foo', $a[new MyString('f')]);

        $a[new MyString('q')] = 'qux';

        $this->assertSame('qux', $a['q']);

        unset($a[new MyString('b')]);

        $this->assertFalse(isset($a['b']));
    }
}
