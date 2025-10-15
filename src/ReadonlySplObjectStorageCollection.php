<?php

namespace alcamo\collection;

/**
 * @brief Readonly collection class based on an SplObjectStorage as its inner object
 *
 * @date Last reviewed 2025-10-14
 */
class ReadonlySplObjectStorageCollection implements \Countable, \Iterator, \ArrayAccess
{
    use ReadonlySplObjectStorageCollectionTrait;
}
