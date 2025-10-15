<?php

namespace alcamo\collection;

/**
 * @brief Like CollectionTrait, but lookup by matching prefix
 *
 * @date Last reviewed 2025-10-14
 */
trait PrefixFirstMatchCollectionTrait
{
    use ArrayDataTrait;
    use CountableTrait;
    use ArrayIteratorTrait;
    use PrefixFirstMatchReadArrayAccessTrait;
    use WriteArrayAccessTrait;
    use ContainsTrait;
}
