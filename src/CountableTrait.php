<?php

namespace alcamo\collection;

/**
 * @brief Provide the Countable interface accessing $data_
 *
 * @sa [Countable interface](https://www.php.net/manual/en/class.countable)
 *
 * @date Last reviewed 2025-10-13
 */
trait CountableTrait
{
    public function count(): int
    {
        return count($this->data_);
    }
}
