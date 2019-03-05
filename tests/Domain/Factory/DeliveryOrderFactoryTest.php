<?php

namespace App\Tests\Domain\Factory;

use App\Domain\Entity\EnterpriseDeliveryOrder;
use App\Domain\Entity\PersonalDeliveryOrder;
use App\Domain\Factory\DeliveryOrderFactory;
use App\Domain\ValueObject\DeliveryType;
use PHPUnit\Framework\TestCase;

class DeliveryOrderFactoryTest extends TestCase {

    protected $deliveryTypes = [];

    public function setUp() : void {
        $this->deliveryTypes['enterprise'] = new DeliveryType('enterpriseDelivery');
        $this->deliveryTypes['personal'] = new DeliveryType('personalDelivery');
    }

    public function testCreate() {
        $factory = new DeliveryOrderFactory();
        $enterprise_order = $factory->create($this->deliveryTypes['enterprise']);
        $personal_order = $factory->create($this->deliveryTypes['personal']);
        
        $this->assertInstanceOf(PersonalDeliveryOrder::class, $personal_order);
        $this->assertInstanceOf(EnterpriseDeliveryOrder::class, $enterprise_order);
    }
}
