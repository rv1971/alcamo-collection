<?php

namespace alcamo\collection;

/**
 * @brief Provide all array-like interfaces and a property $data_ they refer to.
 *
 * @date Last reviewed 2021-06-08
 */
trait CollectionTrait
{
    use CollectionDataTrait;
    use CountableTrait;
    use ArrayIteratorTrait;
    use ReadArrayAccessTrait;
    use WriteArrayAccessTrait;
    use ArrayContainsTrait;
}
