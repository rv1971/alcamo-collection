<?php

namespace alcamo\collection;

use Ds\Set;

/**
 * @brief Finite set of strings or set of all strings
 *
 * All values are converted to strings and compared as strings.
 *
 * Just as for `Ds\Set`, the methods `add()` and `remove()` modify the object
 * while `intersect()` creates a new object, leving this object unchanged.
 *
 * @date Last reviewed 2025-10-15
 */
class StringSetOrAnyString
{
    private $set_; ///< ?Set; `null` means any string

    /**
     * @param $values Either the constant '*' (meaning any string) or an
     * iterable
     */
    public function __construct($values = null)
    {
        if ($values != '*') {
            $this->set_ = new Set();

            if (isset($values)) {
                /* This ensures that all values are converted to strings if
                 * necessary. */
                $this->add(...$values);
            }
        }
    }

    public function isFinite(): bool
    {
        return isset($this->set_);
    }

    public function contains(string $value): bool
    {
        return !isset($this->set_) || $this->set_->contains($value);
    }

    public function add(string ...$values): void
    {
        if (isset($this->set_)) {
            $this->set_->add(...$values);
        }
    }

    public function remove(string ...$values): void
    {
        if (isset($this->set_)) {
            $this->set_->remove(...$values);
        }
    }

    public function intersect(Set $set): Set
    {
        return isset($this->set_)
            ? $this->set_->intersect($set)
            : $set;
    }
}
