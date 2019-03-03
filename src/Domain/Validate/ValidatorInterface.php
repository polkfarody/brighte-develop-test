<?php

namespace App\Domain\Validate;

use App\Domain\Entity\DeliveryOrderInterface;

interface ValidatorInterface {
    public function validate(DeliveryOrderInterface $object) : bool;
}