<?php

namespace App\Service;

use App\Factory\DeliveryOrderServiceFactory;

class DeliveryOrderService {
    protected $factory;
    public function __construct(DeliveryOrderServiceFactory $factory) {
        var_dumP($factory); exit;
    }

    public function processDeliveryOrders(array $orders ) {}

}