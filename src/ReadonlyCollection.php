<?php

namespace alcamo\collection;

/**
 * @brief Readonly collection class based on an array as its inner object
 *
 * @date Last reviewed 2025-10-14
 */
class ReadonlyCollection implements \Countable, \Iterator, \ArrayAccess
{
    use ReadonlyCollectionTrait;
}
