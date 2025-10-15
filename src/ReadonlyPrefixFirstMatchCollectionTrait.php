<?php

namespace alcamo\collection;

/**
 * @brief Like ReadonlyCollectionTrait, but lookup by matching prefix
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
