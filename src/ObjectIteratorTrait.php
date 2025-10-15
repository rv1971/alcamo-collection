<?php

namespace alcamo\collection;

/**
 * @brief Provide the Iterator interface by accessing an object $data_ that
 *  itself implements the Iterator interface
 *
 * @sa [`Iterator` interface](https://www.php.net/manual/en/class.iterator)
 *
 * @date Last reviewed 2025-10-13
 */
trait ObjectIteratorTrait
{
    public function rewind(): void
    {
        $this->data_->rewind();
    }

    public function current()
    {
        return $this->data_->current();
    }

    public function key()
    {
        return $this->data_->key();
    }

    public function next(): void
    {
        $this->data_->next();
    }

    public function valid(): bool
    {
        return $this->data_->valid();
    }
}
