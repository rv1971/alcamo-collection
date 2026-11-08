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

        /* With $result->data_ instead of $result, this also works if $result
         * is a ReadyonlyCollection. */
        (new $class())->deserialize($text, $result->data_);

        return $result;
    }

    public function __toString(): string
    {
        $class = static::SERIALIZER_CLASS;

        return (new $class())->serialize($this);
    }
}
