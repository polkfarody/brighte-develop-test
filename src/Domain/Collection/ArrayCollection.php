<?php

namespace App\Domain\Collection;

class ArrayCollection implements CollectionInterface {

    protected $items;

    public function __construct(array $items = []) {
        $this->items = $items;
    }

    /**
     * {@inheritdoc}
     */
    public function getAll() : array {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function clear() : CollectionInterface {
        $this->items = [];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function length(): int {
        return count($this->items);
    }
}
