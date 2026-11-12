<?php

namespace alcamo\collection;

use Ds\Set;

/**
 * @brief Provide $data_ as an Set
 *
 * @sa [Ds\Set class](https://www.php.net/manual/en/class.ds-set.php)
 *
 * @date Last reviewed 2026-11-12
 */
trait SetDataTrait
{
    protected $data_; ///< Set

    /**
     * @brief Ensure that $data_ is intitialized with a (potentially empty)
     * Set
     */
    public function __construct(?iterable $data = null)
    {
        $this->data_ = $data instanceof Set ? $data : new Set($data ?? []);
    }

    public function __clone()
    {
        $this->data_ = clone $this->data_;
    }
}
