<?php

namespace alcamo\collection;

/**
 * @brief Like ReadonlyCollection, but lookup by matching prefix
 *
 * @date Last reviewed 2025-10-14
 */
class ReadonlyPrefixFirstMatchCollection implements
    \Countable,
    \Iterator,
    \ArrayAccess
{
    use ReadonlyPrefixFirstMatchCollectionTrait;
}
