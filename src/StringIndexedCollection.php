<?php

namespace alcamo\collection;

/**
 * @namespace alcamo::collection
 *
 * @brief Generic classes and traits that work to some extent like arrays
 */

/**
 * @brief Class that behaves much like a string-indexed array
 */
class StringIndexedCollection implements \Countable, \Iterator, \ArrayAccess
{
    use StringIndexedCollectionTrait;
}
