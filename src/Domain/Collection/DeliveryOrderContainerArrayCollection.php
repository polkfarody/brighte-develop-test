<?php

namespace App\Domain\Collection;

use App\Domain\Container\DeliveryOrderContainer;
use InvalidArgumentException;

class DeliveryOrderContainerArrayCollection extends ArrayCollection {
    /**
     * DeliveryOrderContainerArrayCollection constructor.
     * @param DeliveryOrderContainer[] | array $containers
     */
    public function __construct(array $containers = []) {
        foreach ($containers as $container) {
            if (!$container instanceof DeliveryOrderContainer) {
                throw new InvalidArgumentException('Item must be an instance of DeliveryOrderContainer');
            }
        }

        parent::__construct($containers);
    }
}