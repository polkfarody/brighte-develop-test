<?php

namespace App\Domain\Validate;

interface ValidatableInterface {
    public function setValid() : ValidatableInterface;
    public function setInvalid() : ValidatableInterface;
    public function isValid() : bool;
}