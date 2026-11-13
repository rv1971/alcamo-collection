<?php

namespace alcamo\collection;

use PHPUnit\Framework\TestCase;
use alcamo\exception\ReadonlyViolation;

class ReadonlyMagicAccessCollectionTest extends TestCase
{
    public function testSet()
    {
        $a = new ReadonlyMagicAccessCollection([]);

        $this->expectException(ReadonlyViolation::class);
        $this->expectExceptionMessage(
            'Attempt to modify readonly object <'
                . ReadonlyMagicAccessCollection::class
                . '> in method __set()'
        );

        $a->foo = 1;
    }

    public function testUnset()
    {
        $a = new ReadonlyMagicAccessCollection([ 'x' => 'y' ]);

        $this->expectException(ReadonlyViolation::class);
        $this->expectExceptionMessage(
            'Attempt to modify readonly object <'
                . ReadonlyMagicAccessCollection::class
                . '> in method __unset()'
        );

        unset($a->x);
    }
}
