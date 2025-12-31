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
    /**
     * $data_ is initialized with an empty array here so that it is guaranteed
     * to be initialized, even when a class using this trait overwrites the
     * constructor.
     */
    protected $data_ = [];

    public function __construct(?array $data = null)
    {
        if (isset($data)) {
            $this->data_ = $data;
        }
    }

    /// Return all array keys
    public function getKeys(): array
    {
        return array_keys($this->data_);
    }

    /**
     * @brief Add $data to $data_ with the += operator
     *
     * @param array|Collection $data Data to add.
     *
     * @return $this
     */
    public function add($data): self
    {
        $this->data_ += is_array($data) ? $data : $data->data_;

        return $this;
    }
}
