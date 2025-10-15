<?php

namespace alcamo\collection;

/**
 * @brief Collection trait based on an SplObjectStorage as its inner object
 *
 * @sa [SplObjectStorage class](https://www.php.net/manual/en/class.splobjectstorage)
 *
 * @date Last reviewed 2025-10-14
 */
trait SplObjectStorageCollectionTrait
{
    use SplObjectStorageDataTrait;
    use CountableTrait;
    use SplObjectStorageIteratorTrait;
    use ReadArrayAccessTrait;
    use WriteArrayAccessTrait;
}
