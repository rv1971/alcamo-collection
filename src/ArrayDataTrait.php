<?php

namespace alcamo\collection;

/**
 * @namespace alcamo::collection
 *
 * @brief Collection traits and classes
 */

/**
 * @brief Provide $data_ as an array
 *
 * @date Last reviewed 2025-10-12
 */
trait ArrayDataTrait
{
    protected $data_; ///< array

    /// Ensure that $data_ is intitialized with a (potentially empty) array
    public function __construct(?array $data = null)
    {
        $this->data_ = $data ?? [];
    }
}
