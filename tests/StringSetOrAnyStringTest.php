<?php

namespace alcamo\collection;

use alcamo\string\StringObject;
use Ds\Set;
use PHPUnit\Framework\TestCase;

class StringSetOrAnyStringTest extends TestCase
{
    public function testBasics(): void
    {
        $set1 = new StringSetOrAnyString('*');

        $this->assertFalse($set1->isFinite());

        $this->assertTrue($set1->contains('foo'));
        $this->assertTrue($set1->contains(new StringObject('bar')));

        $set2 = new StringSetOrAnyString('*');

        $set2->add('foo');
        $set2->remove('bar');

        $this->assertFalse($set2->isFinite());

        $this->assertEquals($set1, $set2);

        $set3 = new StringSetOrAnyString([ 'baz', new StringObject('qux') ]);

        $this->assertTrue($set3->isFinite());

        $this->assertTrue($set3->contains(new StringObject('baz')));
        $this->assertTrue($set3->contains('qux'));

        $this->assertFalse($set3->contains(new StringObject('foo')));
        $this->assertFalse($set3->contains('bar'));

        $set3->add(new StringObject('quux'));
        $set3->remove(new StringObject('qux'));

        $this->assertTrue($set3->isFinite());

        $this->assertFalse($set3->contains('qux'));
        $this->assertTrue($set3->contains('quux'));

        $set4 = new StringSetOrAnyString(['baz', 'quux']);

        $this->assertEquals($set3, $set4);

        $set5 = new StringSetOrAnyString();

        $this->assertTrue($set5->isFinite());

        $this->assertFalse($set3->contains('foo'));

        $fooBarBazSet = new Set([ 'foo', 'bar', 'baz' ]);

        $this->assertEquals($fooBarBazSet, $set1->intersect($fooBarBazSet));

        $this->assertEquals(
            new Set([ 'baz' ]),
            $set3->intersect($fooBarBazSet)
        );
    }
}
