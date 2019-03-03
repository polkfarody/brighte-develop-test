<?php

namespace App\Domain\Collection;

interface CollectionInterface {
    /**
     * Return all items in the collection
     * @return array
     */
    public function getAll() : array;

    /**
     * Removes all items from collection
     * @return CollectionInterface
     */
    public function clear() : CollectionInterface;

    /**
     * Returns the number of items in the collection
     * @return int
     */
    public function length() : int;
}