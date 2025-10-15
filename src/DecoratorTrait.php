<?php

namespace alcamo\collection;

/**
 * @brief Forward calls of unknown methods to $data_
 *
 * @date Last reviewed 2025-10-12
 */
trait DecoratorTrait
{
    public function __call(string $name, array $params)
    {
        return call_user_func_array([ $this->data_, $name ], $params);
    }
}
