<?php

namespace alcamo\collection;

use alcamo\exception\Unsupported;
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

    /// Whether this is a proper subset of the set of all string
    public function isFinite(): bool
    {
        return isset($this->set_);
    }

    public function contains(string $value): bool
    {
        return !isset($this->set_) || $this->set_->contains($value);
    }

    /**
     * @brief Add strings to the set
     *
     * If the present object is the set of all strings, this does not make a
     * difference.
     */
    public function add(string ...$values): void
    {
        if (isset($this->set_)) {
            $this->set_->add(...$values);
        }
    }

    /// Remove strings from the set if the set is finite
    public function remove(string ...$values): void
    {
        if (isset($this->set_)) {
            $this->set_->remove(...$values);
        } elseif ($values) {
            /** @throw alcamo::exception::Unsupported when attempting to
             *  remove a nonempty set of strings from the set of all
             *  strings. */
            throw (new Unsupported())->setMessageContext(
                [
                    'value' => $values,
                    'feature' => 'removal from the set of all strings'
                ]
            );
        }
    }

    /// Create a Set object as an intersection of $set with $this
    public function intersect(Set $set): Set
    {
        return isset($this->set_)
            ? $this->set_->intersect($set)
            : $set;
    }
}
