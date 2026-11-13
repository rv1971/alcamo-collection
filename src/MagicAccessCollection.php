<?php

namespace alcamo\collection;

/**
 * @brief Collection class with magic access based on an array as its inner
 * object
 *
 * @date Last reviewed 2026-11-13
 */
class MagicAccessCollection implements \Countable, \Iterator
{
    use ArrayDataTrait;
    use CountableTrait;
    use ArrayIteratorTrait;
    use ReadMagicAccessTrait;
    use WriteMagicAccessTrait;
}
