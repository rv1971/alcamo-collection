<?php

namespace alcamo\collection;

/**
 * @brief Readonly collection trait based on an SplObjectStorage as its inner object
 *
 * @date Last reviewed 2025-10-14
 */
trait ReadonlySplObjectStorageCollectionTrait
{
    use SplObjectStorageDataTrait;
    use CountableTrait;
    use SplObjectStorageIteratorTrait;
    use ReadArrayAccessTrait;
    use PreventWriteArrayAccessTrait;
    use ContainsTrait;
}
