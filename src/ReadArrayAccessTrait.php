<?php

namespace alcamo\collection;

/**
 * @brief Provide the read methods of ArrayAccess accessing $data_
 *
 * @sa [ArrayAccess interface](https://www.php.net/manual/en/class.arrayaccess)
 *
 * @date Last reviewed 2025-10-12
 */
trait ReadArrayAccessTrait
{
    /**
     * @attention Returns `false` if an item at $offset exists but has the
     * value `null`. (This is possible if $data_ is an array.) Thus,
     * `offsetExists($offset) == false` is equivalent to `offsetGet($offset)
     * === null`.
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data_[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data_[$offset] ?? null;
    }
}
