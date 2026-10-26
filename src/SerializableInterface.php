<?php

namespace alcamo\collection;

/**
 * @brief Provide conversion from and to a literal
 *
 * @date Last reviewed 2026-10-26
 */
interface SerializableInterface
{
    /// Serializer class to use
    public const SERIALIZER_CLASS = Rfc4514Serializer::class;

    public static function newFromString(string $text): object;

    public function __toString(): string;
}
