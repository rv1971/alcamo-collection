<?php

namespace alcamo\collection;

/**
 * @namespace alcamo::collection
 *
 * @brief Collection traits and classes featuring array-like behaviour
 */

/**
 * @brief Collection class based on an array as its inner object
 *
 * @date Last reviewed 2025-10-14
 */
class Collection implements \Countable, \Iterator, \ArrayAccess
{
    use CollectionTrait;
}
