<?php

namespace alcamo\collection;

use alcamo\exception\ReadonlyViolation;

/**
 * @brief Provide writing methods for properties that always throw
 *
 * Together with `ReadMagicAccessTrait` or any other implementation of the
 * magic reading methods, this can be used to build a class that supports
 * magic access in a readonly way.
 *
 * @date Last reviewed 2026-11-13
 */
trait PreventWriteMagicAccessTrait
{
    public function __set($name, $value): void
    {
        /** @throw alcamo::exception::ReadonlyViolation in every
         *  invocation. */
        throw new ReadonlyViolation();
    }

    public function __unset($name): void
    {
        /** @throw alcamo::exception::ReadonlyViolation in every
         *  invocation. */
        throw new ReadonlyViolation();
    }
}
