<?php

namespace alcamo\collection;

/**
 * @brief Provide the write methods of ArrayAccess accessing $data_, indexed
 * by strings
 *
 * The only difference to WriteArrayAccessTrait is that the present trait
 * accepts offsets of any type and converts them to strings.
 *
 * @sa [ArrayAccess interface](https://www.php.net/manual/en/class.arrayaccess)
 *
 * @date Last reviewed 2025-10-12
 */
trait StringIndexedWriteArrayAccessTrait
{
    public function offsetSet($offset, $value): void
    {
        $this->data_[(string)$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->data_[(string)$offset]);
    }
}
