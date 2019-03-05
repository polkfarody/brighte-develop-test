<?php

namespace App\Domain\Exception;

class InvalidKeyLoadedException extends DomainException {
    public function __construct($reqKey) {
        parent::__construct("Load Failed: $reqKey is not type string.");
    }
}