<?php

namespace alcamo\collection;

use Ds\Set;

/**
 * @brief Finite set of strings or set of all strings
 *
 * All values are converted to strings and compared as strings.
 */
class StringSetOrAnyString
{
    private $set_; ///< ?Set; `null` means any string

    /**
     * @param $values The constant '*' (meaning any string) or an array or
     * traversable
     */
    public function __construct($values = null)
    {
        if ($values != '*') {
            $this->set_ = new Set();

            if (isset($values)) {
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
