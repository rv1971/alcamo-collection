<?php

namespace alcamo\collection;

/**
 * @brief Provide methods to modify array data
 *
 * @date Last reviewed 2025-12-31
 */
trait ModifyArrayDataTrait
{
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
