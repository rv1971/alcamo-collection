<?php

namespace alcamo\collection;

/**
 * @brief Collection class with conversion from and to RFC 4514 literal
 *
 * @date Last reviewed 2026-10-26
 */
class SerializableCollection extends Collection implements SerializableInterface
{
    use SerializableTrait;
}
