<?php

namespace App\Tests\Domain\Factory;

use App\Domain\Entity\Enterprise;
use App\Domain\Factory\EnterpriseFactory;
use PHPUnit\Framework\TestCase;

class EnterpriseFactoryTest extends TestCase {

    public function testCreate() {
        $factory = new EnterpriseFactory();
        $enterprise = $factory->create();

        $this->assertInstanceOf(Enterprise::class, $enterprise);
    }
}
