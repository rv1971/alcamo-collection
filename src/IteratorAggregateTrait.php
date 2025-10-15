<?php

namespace alcamo\collection;

/**
 * @brief Provide the IteratorAggregate interface accessing $data_
 *
 * @sa [IteratorAggregate interface](https://www.php.net/manual/en/class.iteratoraggregate)
 *
 * @date Last reviewed 2025-10-13
 */
trait IteratorAggregateTrait
{
    public function getIterator(): \Traversable
    {
        return $this->data_;
    }
}
