<?php

namespace App\Domain\Entity;

use App\Domain\Mapper\MappableInterface;
use Serializable;

class Invoice implements InvoiceInterface {
    /**
     * @var int
     */
    protected $id;

    /**
     * @var DeliveryOrderInterface
     */
    protected $delivery;

    /**
     * @var string
     */
    protected $billing_info;

    /**
     * @return string
     */
    public function getInvoiceNo(): string {
        return 'INV' . str_pad($this->id, '10', '0', STR_PAD_LEFT);
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Invoice
     */
    public function setId(int $id): Invoice {
        $this->id = $id;
        return $this;
    }

    /**
     * @return DeliveryOrderInterface
     */
    public function getDeliveryOrder(): DeliveryOrderInterface {
        return $this->delivery;
    }

    /**
     * @param DeliveryOrderInterface $delivery
     * @return Invoice
     */
    public function setDeliveryOrder(DeliveryOrderInterface $delivery): Invoice {
        $this->delivery = $delivery;
        return $this;
    }

    /**
     * Getting tired just returning custom strings.
     * @return string
     */
    public function getBillingInfo(): string {
        return $this->delivery->getCustomer()->getAddress();
    }
}