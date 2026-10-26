<?php

namespace alcamo\collection;

/**
 * @brief Implementation of SerializableInterface
 *
 * @date Last reviewed 2026-10-26
 */
trait SerializableTrait
{
    public static function newFromString(string $text): object
    {
        $result = new static();

        $class = static::SERIALIZER_CLASS;

        return (new $class())->deserialize($text, $result);
    }

    public function __toString(): string
    {
        $class = static::SERIALIZER_CLASS;

        return (new $class())->serialize($this);
    }
}
