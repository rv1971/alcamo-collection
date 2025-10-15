<?php

namespace alcamo\collection;

use PHPUnit\Framework\TestCase;

class MyCollection extends Collection
{
    use CloneTrait;
}

class MySplObjectStorageCollection extends SplObjectStorageCollection
{
    use CloneTrait;
}

class CloneTest extends TestCase
{
    public function testCloneCollection()
    {
        $collection1 = new Collection();
        $collection1[0] = (object)[ 'bar' => 'baz' ];

        $collection2 = clone $collection1;

        $collection2[0]->bar = 'qux';

        $this->assertSame('qux', $collection1[0]->bar);

        $this->assertSame('qux', $collection2[0]->bar);

        $collection3 = new MyCollection();
        $collection3[0] = (object)[ 'bar' => 'baz' ];

        $collection4 = clone $collection3;

        $collection4[0]->bar = 'qux';

        $this->assertSame('baz', $collection3[0]->bar);

        $this->assertSame('qux', $collection4[0]->bar);
    }

    public function testCloneSplObjectStorageCollection()
    {
        $key = (object)[];

        $collection1 = new SplObjectStorageCollection();
        $collection1[$key] = 'bar';

        $collection2 = clone $collection1;

        $collection2[$key] = 'qux';

        $this->assertSame('qux', $collection1[$key]);

        $this->assertSame('qux', $collection2[$key]);

        $collection3 = new MySplObjectStorageCollection();
        $collection3[$key] = 'bar';

        $collection4 = clone $collection3;

        $collection4[$key] = 'qux';

        $this->assertSame('bar', $collection3[$key]);

        $this->assertSame('qux', $collection4[$key]);
    }
}
