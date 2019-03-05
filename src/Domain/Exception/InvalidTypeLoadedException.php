<?php

namespace App\Domain\Exception;

class InvalidTypeLoadedException extends DomainException {
    public function __construct(string $reqType, string $reqKey) {
        parent::__construct("Load Failed: $reqKey is not type $reqType.");
    }
}