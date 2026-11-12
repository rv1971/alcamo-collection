<?php

namespace alcamo\collection;

/**
 * @brief Collection class based on a Set as its inner object
 *
 * @sa [Ds\Set class](https://www.php.net/manual/en/class.ds-set.php)
 *
 * @date Last reviewed 2026-11-12
 */
class SetCollection implements \Countable, \IteratorAggregate
{
    use SetCollectionTrait;
}
