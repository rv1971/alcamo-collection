<?php

namespace alcamo\collection;

use PHPUnit\Framework\TestCase;
use alcamo\exception\ReadonlyViolation;

class ReadonlyCollectionTest extends TestCase
{
    public function testSet()
    {
        $a = new ReadonlyCollection([]);

        $this->expectException(ReadonlyViolation::class);
        $this->expectExceptionMessage(
            'Attempt to modify readonly object <' . ReadonlyCollection::class
            . '> in method offsetSet()'
        );

        $a[0] = 1;
    }

    public function testUnset()
    {
        $a = new ReadonlyCollection([ 'x' ]);

        $this->expectException(ReadonlyViolation::class);
        $this->expectExceptionMessage(
            'Attempt to modify readonly object <' . ReadonlyCollection::class
            . '> in method offsetUnset()'
        );

        unset($a[0]);
    }
}
