<?php

namespace alcamo\collection;

/**
 * @brief Provide the reading methods of the ArrayAccess interface accessing
 * a class property $data_ indexed by strings
 *
 * @attention Any class using this trait must provide a class property $data_
 * which must contain an array or an
 * [ArrayAccess](https://www.php.net/manual/en/class.arrayaccess).
 *
 * The only difference to ReadArrayAccessTrait is that the present class
 * accepts offsets of any type and converts them to strings.
 *
 * @sa [ArrayAccess interface](https://www.php.net/manual/en/class.arrayaccess)
 */
trait ReadStringIndexedArrayAccessTrait
{
    public function offsetExists($offset)
    {
        return isset($this->data_[(string)$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data_[(string)$offset] ?? null;
    }
}
