<?php

namespace alcamo\collection;

/**
 * @brief Like ReadonlyCollectionTrait, but lookup by matching prefix
 *
 * @date Last reviewed 2025-10-14
 */
trait ReadonlyPrefixFirstMatchCollectionTrait
{
    use ArrayDataTrait;
    use CountableTrait;
    use ArrayIteratorTrait;
    use PrefixFirstMatchReadArrayAccessTrait;
    use PreventWriteArrayAccessTrait;
    use ArrayContainsTrait;
}
