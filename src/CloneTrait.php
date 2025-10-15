<?php

namespace alcamo\collection;

/**
 * @brief Clone $data_ when cloning the object
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
