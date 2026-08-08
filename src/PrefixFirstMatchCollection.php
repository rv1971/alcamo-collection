<?php

namespace alcamo\collection;

/**
 * @brief Like Collection, but lookup by matching prefix
 *
 * @date Last reviewed 2025-10-14
 */
class PrefixFirstMatchCollection implements CollectionInterface
{
    use PrefixFirstMatchCollectionTrait;
}
