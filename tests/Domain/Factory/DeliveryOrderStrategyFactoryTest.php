<?php

namespace App\Tests\Domain\Factory;

use App\Domain\Factory\DeliveryOrderStrategyFactory;
use App\Domain\Strategy\EnterpriseDeliveryOrderStrategy;
use App\Domain\Strategy\PersonalDeliveryOrderStrategy;
use App\Domain\ValueObject\DeliveryType;
use PHPUnit\Framework\TestCase;

class DeliveryOrderStrategyFactoryTest extends TestCase {

    protected $deliveryTypes = [];
    protected $factory;

    public function setUp() : void {
        $this->deliveryTypes['enterprise'] = new DeliveryType('enterpriseDelivery');
        $this->deliveryTypes['personal'] = new DeliveryType('personalDelivery');

        $this->factory = new DeliveryOrderStrategyFactory();
    }

    public function testCreate() {
        $enterprise_order = $this->factory->create($this->deliveryTypes['enterprise']);
        $this->assertInstanceOf(EnterpriseDeliveryOrderStrategy::class, $enterprise_order);

        $personal_order = $this->factory->create($this->deliveryTypes['personal']);
        $this->assertInstanceOf(PersonalDeliveryOrderStrategy::class, $personal_order);
    }
}
