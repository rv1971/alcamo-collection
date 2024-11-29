<?php

namespace alcamo\collection;

/**
 * @brief Provide the writing methods of the ArrayAccess interface accessing
 * a class property $data_ indexed by strings
 *
 * @attention Any class using this trait must provide a class property $data_
 * which must contain an array or an
 * [ArrayAccess](https://www.php.net/manual/en/class.arrayaccess).
 *
 * The only difference to WriteArrayAccessTrait is that the present class
 * accepts offsets of any type and converts them to strings.
 *
 * @sa [ArrayAccess interface](https://www.php.net/manual/en/class.arrayaccess)
 */
trait WriteStringIndexedArrayAccessTrait
{
    public function offsetSet($offset, $value)
    {
        $this->data_[(string)$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data_[(string)$offset]);
    }
}
