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
    /**
     * @attention Returns `false` if an item at $offset exists but has the
     * value `null`. (This is possible if $data_ is an array.) Thus,
     * `offsetExists($offset) == false` is equivalent to `offsetGet($offset)
     * === null`.
     */
    public function offsetExists($offset): bool
    {
        foreach ($this->data_ as $key => $value) {
            /* strncmp() is unsuitable because it would return true also when
             * $offset were a proper intial substring of $key, instead of vice
             * versa. */
            if (isset($value) && substr($offset, 0, strlen($key)) == $key) {
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
