<?php

namespace alcamo\collection;

/**
 * @brief Clone $data_ when cloning the object
 *
 * If $data_ is an array, clone each of its values. This is not recursive, so
 * if $data_ is an array and one of its values is an array which contains an
 * object, that object is not deep-cloned.
 *
 * @date Last reviewed 2025-10-12
 */
trait CloneTrait
{
    public function __clone()
    {
        if (is_object($this->data_)) {
            $this->data_ = clone $this->data_;
        } else {
            foreach ($this->data_ as &$value) {
                if (is_object($value)) {
                    $value = clone $value;
                }
            }
        }
    }
}
