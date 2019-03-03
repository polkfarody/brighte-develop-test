<?php

namespace App\Domain\Exception;

class InvalidDeliveryTypeException extends DomainException {
    public function __construct($delivery_type) {
        parent::__construct("$delivery_type is not a valid delivery type");
    }
}