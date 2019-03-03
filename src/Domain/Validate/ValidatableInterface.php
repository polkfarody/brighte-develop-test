<?php

namespace App\Domain\Validate;

interface ValidatableInterface {
    public function setValid(bool $valid) : ValidatableInterface;
    public function isValid() : bool;
}