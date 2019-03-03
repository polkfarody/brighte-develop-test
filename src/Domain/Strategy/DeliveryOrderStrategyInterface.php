<?php

namespace App\Domain\Strategy;

use App\Domain\Entity\DeliveryOrderInterface;
use App\Domain\Entity\InvoiceInterface;

interface DeliveryOrderStrategyInterface {
    /**
     * @param DeliveryOrderInterface $delivery
     * @return InvoiceInterface
     */
    public function generateInvoice(DeliveryOrderInterface $delivery) : InvoiceInterface;
}