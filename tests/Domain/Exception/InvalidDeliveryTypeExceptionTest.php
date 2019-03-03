<?php

namespace App\Tests\Domain\Exception;

use App\Domain\Exception\InvalidDeliveryTypeException;
use PHPUnit\Framework\TestCase;

class InvalidDeliveryTypeExceptionTest extends TestCase {
    /**
     * test validity of exception message.
     */
    public function test__construct() {
        $exception = new InvalidDeliveryTypeException('deliveryType');

        $this->assertEquals('deliveryType is not a valid delivery type', $exception->getMessage());
    }
}
