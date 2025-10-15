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
    public function offsetExists($offset): bool
    {
        return isset($this->data_[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data_[$offset] ?? null;
    }
}
