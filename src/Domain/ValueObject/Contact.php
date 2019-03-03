<?php

namespace App\Domain\ValueObject;

final class Contact {
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $address;

    /**
     * Contact constructor.
     * @param $name
     * @param $address
     */
    public function __construct($name, $address) {
        $this->name    = $name;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress(): string {
        return $this->address;
    }
}
