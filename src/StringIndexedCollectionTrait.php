<?php

namespace alcamo\collection;

/**
 * @brief Provide all array-like interfaces and a string-indexed property $data_ they refer to
 */
trait StringIndexedCollectionTrait
{
    use CountableTrait;
    use ArrayIteratorTrait;
    use ReadStringIndexedArrayAccessTrait;
    use WriteStringIndexedArrayAccessTrait;
    use ArrayContainsTrait;

    protected $data_ = [];

    /// Ensure that $data_ is intitialized with a (potentially empty) array
    public function __construct(?array $data = null)
    {
        $this->data_ = (array)$data;
    }
}
