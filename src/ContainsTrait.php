<?php

namespace alcamo\collection;

/**
 * @brief Provide contains()
 *
 * @date Last reviewed 2025-10-13
 */
trait ContainsTrait
{
    public function contains($value): bool
    {
        return is_object($this->data_)
            ? $this->data_->contains($value)
            : in_array($value, $this->data_, true);
    }
}
