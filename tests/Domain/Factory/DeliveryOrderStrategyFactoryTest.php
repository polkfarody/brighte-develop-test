<?php

namespace App\Tests\Domain\Factory;

use App\Domain\Factory\DeliveryOrderStrategyFactory;
use App\Domain\Strategy\EnterpriseDeliveryOrderStrategy;
use App\Domain\Strategy\PersonalDeliveryOrderStrategy;
use App\Domain\ValueObject\DeliveryType;
use PHPUnit\Framework\TestCase;

class DeliveryOrderStrategyFactoryTest extends TestCase {

    protected $deliveryTypes = [];

    public function setUp() : void {
        $this->deliveryTypes['enterprise'] = new DeliveryType('enterpriseDelivery');
        $this->deliveryTypes['personal'] = new DeliveryType('personalDelivery');
    }

    public function testCreate() {
        $factory = new DeliveryOrderStrategyFactory();

        $enterprise_order = $factory->create($this->deliveryTypes['enterprise']);
        $this->assertInstanceOf(EnterpriseDeliveryOrderStrategy::class, $enterprise_order);

        $personal_order = $factory->create($this->deliveryTypes['personal']);
        $this->assertInstanceOf(PersonalDeliveryOrderStrategy::class, $personal_order);
    }
}
