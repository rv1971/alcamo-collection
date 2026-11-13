<?php

namespace alcamo\collection;

/**
 * @brief Provide the magic write methods for properties accessing $data_
 *
 * @date Last reviewed 2026-11-13
 */
trait WriteMagicAccessTrait
{
    public function __set($name, $value): void
    {
        $this->data_[$name] = $value;
    }

    public function __unset($name): void
    {
        unset($this->data_[$name]);
    }
}
