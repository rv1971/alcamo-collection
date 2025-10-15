<?php

namespace alcamo\collection;

/**
 * @brief Provide the Iterator interface by accessing an SplObjectStorage
 * $data_
 *
 * Iteration over this class works as one would expect, [unlike
 * SplObjectStorage](https://bugs.php.net/bug.php?id=49967).
 *
 * @sa [Iterator interface](https://www.php.net/manual/en/class.iterator)
 *
 * @sa [SplObjectStorage class](https://www.php.net/manual/en/class.splobjectstorage)
 */
trait SplObjectStorageIteratorTrait
{
    use ObjectIteratorTrait;

    public function current()
    {
        return $this->data_->getInfo();
    }

    public function key()
    {
        return $this->data_->current();
    }
}
