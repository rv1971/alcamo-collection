<?php

namespace alcamo\collection;

/**
 * @brief Collection trait based on an array as its inner object
 *
 * @date Last reviewed 2025-10-14
 */
trait CollectionTrait
{
    use ArrayDataTrait;
    use CountableTrait;
    use ArrayIteratorTrait;
    use StringIndexedReadArrayAccessTrait;
    use StringIndexedWriteArrayAccessTrait;
    use ContainsTrait;
}
