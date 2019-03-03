<?php

namespace App\Domain\Factory;

use App\Domain\Entity\DeliveryOrderInterface;
use App\Domain\Entity\Invoice;
use App\Domain\Entity\InvoiceInterface;

class InvoiceFactory {
    /**
     * @param DeliveryOrderInterface $order
     * @return InvoiceInterface
     * @throws \Exception
     */
    public function create(DeliveryOrderInterface $order) : InvoiceInterface {
        return (new Invoice())->setId(random_int(1, 99999))
            ->setDeliveryOrder($order);
    }
}