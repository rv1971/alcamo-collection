<?php

namespace alcamo\collection;

/**
 * @brief Provide the read methods of ArrayAccess interface accessing $data_,
 * indexed by strings
 *
 * The only difference to ReadArrayAccessTrait is that the present trait
 * accepts offsets of any type and converts them to strings.
 *
 * @sa [ArrayAccess interface](https://www.php.net/manual/en/class.arrayaccess)
 *
 * @date Last reviewed 2025-10-12
 */
trait StringIndexedReadArrayAccessTrait
{
    /**
     * @attention Returns `false` if an item at $offset exists but has the
     * value `null`. (This is possible if $data_ is an array.) Thus,
     * `offsetExists($offset) == false` is equivalent to `offsetGet($offset)
     * === null`.
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data_[(string)$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data_[(string)$offset] ?? null;
    }
}
