<?php

namespace alcamo\collection;

/**
 * @brief Collection trait based on a Set as its inner object
 *
 * @sa [Ds\Set class](https://www.php.net/manual/en/class.ds-set.php)
 *
 * @date Last reviewed 2025-10-14
 */
trait SetCollectionTrait
{
    use SetDataTrait;
    use CountableTrait;
    use IteratorAggregateTrait;
}
