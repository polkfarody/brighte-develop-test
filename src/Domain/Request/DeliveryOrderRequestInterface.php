<?php

namespace App\Domain\Request;

use App\Domain\Collection\DeliveryOrderContainerArrayCollection;

interface DeliveryOrderRequestInterface {
    public function getOrders() : DeliveryOrderContainerArrayCollection;
}