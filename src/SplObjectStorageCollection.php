<?php

namespace alcamo\collection;

/**
 * @brief Collection class based on an SplObjectStorage as its inner object
 *
 * @sa [SplObjectStorage class](https://www.php.net/manual/en/class.splobjectstorage)
 *
 * @date Last reviewed 2025-10-14
 */
class SplObjectStorageCollection implements \Countable, \Iterator, \ArrayAccess
{
    use SplObjectStorageCollectionTrait;
}
