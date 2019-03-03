<?php

namespace App\Domain\Entity;

use App\Domain\Mapper\MappableInterface;
use App\Domain\ValueObject\Contact;
use App\Domain\ValueObject\DeliveryType;

class EnterpriseDeliveryOrder implements EnterpriseDeliveryOrderInterface, DeliveryOrderInterface {
    /**
     * @var Contact
     */
    protected $customer;

    /**
     * @var String
     */
    protected $deliveryType;

    /**
     * @var String
     */
    protected $source;

    /**
     * @var int
     */
    protected $weight;

    /**
     * @var Enterprise
     */
    protected $enterprise;

    /**
     * @var string|null
     */
    protected $onBehalf;

    /**
     * EnterpriseDeliveryOrder constructor.
     * @param DeliveryType|null $deliveryType
     * @param Contact|null $customer
     * @param string|null $source
     * @param int|null $weight
     * @param Enterprise|null $enterprise
     * @param string|null $onBehalf
     */
    public function __construct(DeliveryType $deliveryType = null, Contact $customer = null, string $source = null, int $weight = null, Enterprise $enterprise = null, string $onBehalf = null) {
        $this->deliveryType = $deliveryType;
        $this->customer = $customer;
        $this->source = $source;
        $this->weight = $weight;
        $this->enterprise = $enterprise;
        $this->onBehalf = $onBehalf;
    }
    /**
     * @return Contact
     */
    public function getCustomer(): Contact {
        return $this->customer;
    }

    /**
     * @param Contact $customer
     * @return DeliveryOrderInterface
     */
    public function setCustomer(Contact $customer): DeliveryOrderInterface {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return DeliveryType
     */
    public function getDeliveryType(): DeliveryType {
        return $this->deliveryType;
    }

    /**
     * @param DeliveryType $deliveryType
     * @return DeliveryOrderInterface
     */
    public function setDeliveryType(DeliveryType $deliveryType): DeliveryOrderInterface {
        $this->deliveryType = $deliveryType;
        return $this;
    }

    /**
     * @return String
     */
    public function getSource(): String {
        return $this->source;
    }

    /**
     * @param String $source
     * @return DeliveryOrderInterface
     */
    public function setSource(String $source): DeliveryOrderInterface {
        $this->source = $source;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeight(): int {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return DeliveryOrderInterface
     */
    public function setWeight(int $weight): DeliveryOrderInterface {
        $this->weight = $weight;
        return $this;
    }

    public function isExpress(): bool {
        return $this->deliveryType->isExpress();
    }

    public function getEnterprise(): Enterprise {
        return $this->enterprise;
    }

    public function setEnterprise(Enterprise $enterprise) : DeliveryOrderInterface {
        $this->enterprise = $enterprise;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOnBehalf(): ?string {
        return $this->onBehalf;
    }

    /**
     * @param string|null $onBehalf
     * @return DeliveryOrderInterface
     */
    public function setOnBehalf(string $onBehalf = null): DeliveryOrderInterface {
        $this->onBehalf = $onBehalf;
        return $this;
    }


}