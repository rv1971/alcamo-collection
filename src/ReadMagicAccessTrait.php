<?php

namespace alcamo\collection;

/**
 * @brief Provide the magic read methods for properties accessing $data_
 *
 * @date Last reviewed 2026-11-13
 */
trait ReadMagicAccessTrait
{
    /**
     * @attention Returns `false` if an item at $name exists but has the value
     * `null`. (This is possible if $data_ is an array.) Thus, `__isset($name)
     * == false` is equivalent to `__get($name) === null`.
     */
    public function __isset($name): bool
    {
        return isset($this->data_[$name]);
    }

    public function __get($name)
    {
        return $this->data_[$name] ?? null;
    }
}
