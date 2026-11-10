<?php

namespace alcamo\collection;

/**
 * @brief Readyonly collection class with conversion from and to RFC 4514
 * literal
 *
 * @date Last reviewed 2026-11-08
 */
class SerializableReadonlyCollection extends ReadonlyCollection implements
    SerializableInterface
{
    use SerializableTrait;
}
