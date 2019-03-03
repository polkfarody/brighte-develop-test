<?php

namespace App\Domain\Strategy;

use App\Domain\Entity\DeliveryOrderInterface;
use App\Domain\Entity\InvoiceInterface;
use App\Domain\Factory\InvoiceFactory;

class PersonalDeliveryOrderStrategy implements DeliveryOrderStrategyInterface {
    protected $factory;

    public function __construct(InvoiceFactory $factory) {
        $this->factory = $factory;
    }

    /**
     * @param DeliveryOrderInterface $delivery
     * @return InvoiceInterface
     * @throws \Exception
     */
    public function generateInvoice(DeliveryOrderInterface $delivery) : InvoiceInterface {
        return $this->factory->create($delivery);
    }
}