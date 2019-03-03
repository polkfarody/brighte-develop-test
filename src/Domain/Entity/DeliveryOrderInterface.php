<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Contact;
use App\Domain\ValueObject\DeliveryType;

interface DeliveryOrderInterface {
    public function getCustomer() : Contact;
    public function getSource() : string;
    public function getDeliveryType() : DeliveryType;
    public function getWeight() : int;
    public function getOnBehalf() : ? string;
    public function setCustomer(Contact $contact) : DeliveryOrderInterface;
    public function setSource(string $source) : DeliveryOrderInterface;
    public function setDeliveryType(DeliveryType $deliveryType) : DeliveryOrderInterface;
    public function setWeight(int $weight) : DeliveryOrderInterface;
    public function setOnBehalf(string $onBehalf) : DeliveryOrderInterface;
    public function isExpress() : bool;
}