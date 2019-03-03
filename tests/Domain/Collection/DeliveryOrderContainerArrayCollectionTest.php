<?php

namespace App\Tests\Domain\Collection;

use App\Domain\Collection\DeliveryOrderContainerArrayCollection;
use PHPUnit\Framework\TestCase;

class DeliveryOrderContainerArrayCollectionTest extends TestCase {
    /**
     * Tests the type of object in the items array.
     */
    public function test__construct() {
        $this->expectException(\InvalidArgumentException::class);
        new DeliveryOrderContainerArrayCollection([
            (new Class {}),
            (new Class {})
        ]);
    }
}
