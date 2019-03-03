<?php
/**
 * Created by PhpStorm.
 * User: Polk Farody
 * Date: 3/03/2019
 * Time: 12:21 PM
 */

namespace App\Tests\Domain\Factory;

use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Mapper\EnterpriseDeliveryOrderMapper;
use App\Domain\Mapper\PersonalDeliveryOrderMapper;
use App\Domain\ValueObject\DeliveryType;
use PHPUnit\Framework\TestCase;

class DeliveryOrderMapperFactoryTest extends TestCase {

    protected $deliveryTypes = [];
    protected $factory;

    public function setUp() : void {
        $this->deliveryTypes['enterprise'] = new DeliveryType('enterpriseDelivery');
        $this->deliveryTypes['personal'] = new DeliveryType('personalDelivery');

        $this->factory = new DeliveryOrderMapperFactory();
    }

    public function testCreate() {
        $enterprise_order = $this->factory->create($this->deliveryTypes['enterprise']);
        $this->assertInstanceOf(EnterpriseDeliveryOrderMapper::class, $enterprise_order);

        $personal_order = $this->factory->create($this->deliveryTypes['personal']);
        $this->assertInstanceOf(PersonalDeliveryOrderMapper::class, $personal_order);
    }
}
