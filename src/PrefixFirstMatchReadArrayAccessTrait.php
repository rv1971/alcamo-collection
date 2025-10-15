<?php

namespace alcamo\collection;

/**
 * @brief Read the first array item matching an initial portion of an offset
 * string
 *
 * This implementation looks for the *first* array element whose key matches
 * an initial substring of $offset. This implies that order of the underlying
 * array may be significant.
 *
 * @date Last reviewed 2025-10-14
 */
trait PrefixFirstMatchReadArrayAccessTrait
{
    public function offsetExists($offset): bool
    {
        foreach ($this->data_ as $key => $value) {
            /* strncmp() is unsuitable because it would return true also when
             * $offset were a proper intial substring of $key, instead of vice
             * versa. */
            if (substr($offset, 0, strlen($key)) == $key) {
                return true;
            }
        }

        return false;
    }

    public function offsetGet($offset)
    {
        foreach ($this->data_ as $key => $value) {
            if (substr($offset, 0, strlen($key)) == $key) {
                return $value;
            }
        }

        return null;
    }
}
