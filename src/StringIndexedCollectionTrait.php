<?php

namespace alcamo\collection;

/**
 * @brief Provide all array-like interfaces and a string-indexed property $data_ they refer to
 */
trait StringIndexedCollectionTrait
{
    use CollectionDataTrait;
    use CountableTrait;
    use ArrayIteratorTrait;
    use ReadStringIndexedArrayAccessTrait;
    use WriteStringIndexedArrayAccessTrait;
    use ArrayContainsTrait;
}
