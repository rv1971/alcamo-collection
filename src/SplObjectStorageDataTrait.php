<?php

namespace alcamo\collection;

/**
 * @brief Provide $data_ as an SplObjectStorage
 *
 * @sa [SplObjectStorage class](https://www.php.net/manual/en/class.splobjectstorage)
 *
 * @date Last reviewed 2025-10-12
 */
trait SplObjectStorageDataTrait
{
    protected $data_; ///< SplObjectStorage

    /**
     * @brief Ensure that $data_ is intitialized with a (potentially empty)
     * SplObjectStorage
     */
    public function __construct(?\SplObjectStorage $data = null)
    {
        $this->data_ = $data ?? new \SplObjectStorage();
    }
}
