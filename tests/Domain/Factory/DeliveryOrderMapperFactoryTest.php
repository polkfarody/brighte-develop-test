<?php

namespace App\Tests\Domain\Factory;

use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Mapper\EnterpriseDeliveryOrderMapper;
use App\Domain\Mapper\PersonalDeliveryOrderMapper;
use App\Domain\ValueObject\DeliveryType;
use PHPUnit\Framework\TestCase;

class DeliveryOrderMapperFactoryTest extends TestCase {

    protected $deliveryTypes = [];

    public function setUp() : void {
        $this->deliveryTypes['enterprise'] = new DeliveryType('enterpriseDelivery');
        $this->deliveryTypes['personal'] = new DeliveryType('personalDelivery');
    }

    public function testCreate() {
        $factory = new DeliveryOrderMapperFactory();

        $enterprise_order = $factory->create($this->deliveryTypes['enterprise']);
        $this->assertInstanceOf(EnterpriseDeliveryOrderMapper::class, $enterprise_order);

        $personal_order = $factory->create($this->deliveryTypes['personal']);
        $this->assertInstanceOf(PersonalDeliveryOrderMapper::class, $personal_order);
    }
}
