<?php

namespace App\Domain\ValueObject;

use App\Domain\Exception\InvalidDeliveryTypeException;

final class DeliveryType {
    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private static $valid_types = ['enterpriseDelivery', 'enterpriseDeliveryExpress', 'personalDelivery', 'personalDeliveryExpress'];

    /**
     * DeliveryType constructor.
     * @param string $type
     * @throws InvalidDeliveryTypeException
     */
    public function __construct(string $type) {
        if (!in_array($type, self::$valid_types)) {
            throw new InvalidDeliveryTypeException($type);
        }

        $this->type = $type;
    }

    public function getValue() {
        return $this->type;
    }

    public function getType() {
        $type = null;
        if (stripos($this->type, 'enterprise') === 0) {
            $type = 'enterprise';
        } elseif (stripos($this->type, 'personal') === 0) {
            $type = 'personal';
        }

        return $type;
    }


    public function isExpress() {
        return stripos($this->type, 'express') !== false;
    }
}