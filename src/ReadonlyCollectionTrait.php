<?php

namespace alcamo\collection;

/**
 * @brief Readonly collection trait based on an array as its inner object
 *
 * @date Last reviewed 2025-10-14
 */
trait ReadonlyCollectionTrait
{
    use ArrayDataTrait;
    use CountableTrait;
    use ArrayIteratorTrait;
    use StringIndexedReadArrayAccessTrait;
    use PreventWriteArrayAccessTrait;
    use ContainsTrait;
}
