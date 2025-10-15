<?php

namespace alcamo\collection;

/**
 * @brief Provide the write methods of ArrayAccess accessing $data_
 *
 * @sa [ArrayAccess interface](https://www.php.net/manual/en/class.arrayaccess)
 *
 * @date Last reviewed 2025-10-12
 */
trait WriteArrayAccessTrait
{
    public function offsetSet($offset, $value): void
    {
        $this->data_[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->data_[$offset]);
    }
}
