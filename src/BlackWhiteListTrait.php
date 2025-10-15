<?php

namespace alcamo\collection;

/**
 * @brief Common code for black/white-lists
 *
 * This trait deliberately lacks a constructor or any other method to set
 * `$isBlacklist_` since this depends on the way it is used.
 *
 * @date Last reviewed 2025-10-14
 */
trait BlackWhiteListTrait
{
    private $isBlacklist_; ///< bool

    /// Whether this is a blacklist
    public function isBlacklist(): bool
    {
        return $this->isBlacklist_;
    }

    /// Whether $value is allowed by this list
    public function allows(string $value): bool
    {
        /**
         * Returns `true` if either
         * - contains() returns `true` and this a whitelist, or
         * - contains() returns `false` and this a blacklist
         */
        return $this->contains($value) xor $this->isBlacklist_;
    }
}
