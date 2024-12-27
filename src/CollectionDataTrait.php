<?php

namespace alcamo\collection;

/**
 * @brief Provide the $data property and related methods
 */
trait CollectionDataTrait
{
    protected $data_;

    /// Ensure that $data_ is intitialized with a (potentially empty) array
    public function __construct(?array $data = null)
    {
        $this->data_ = (array)$data;
    }

    public function getKeys(): array
    {
        return array_keys($this->data_);
    }
}
