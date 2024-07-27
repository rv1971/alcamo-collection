<?php

namespace alcamo\collection;

/**
 * @brief Clone the values of $data_ property when cloning the object
 *
 * May be necessary when $data_ is an array and its valkues ar objects.
 */
trait CloneArrayTrait
{
    public function __clone()
    {
        foreach ($this->data_ as &$value) {
            $value = clone $value;
        }
    }
}
