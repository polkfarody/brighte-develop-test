<?php

namespace App\Delivery\Request;

use App\Domain\Collection\DeliveryOrderContainerArrayCollection;
use App\Domain\Request\DeliveryOrderRequestInterface;

class DeliveryOrderRequest implements DeliveryOrderRequestInterface {
    protected $collection;

    public function __construct(DeliveryOrderContainerArrayCollection $collection) {
        $this->collection = $collection;
    }

    public function getOrders(): DeliveryOrderContainerArrayCollection {
        return $this->collection;
    }
}