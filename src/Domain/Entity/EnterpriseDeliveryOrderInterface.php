<?php

namespace App\Domain\Entity;

interface EnterpriseDeliveryOrderInterface {
    public function getEnterprise() : ?Enterprise;
    public function setEnterprise(Enterprise $enterprise) : DeliveryOrderInterface;
}