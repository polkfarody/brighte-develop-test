<?php

namespace App\Domain\Entity;

interface InvoiceInterface {
    /**
     * @return int
     */
    public function getId() : int;

    /**
     * @return string
     */
    public function getInvoiceNo() : string;

    /**
     * @return string
     */
    public function getBillingInfo() : string;

    public function getDeliveryOrder() : DeliveryOrderInterface;
}