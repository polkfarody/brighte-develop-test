<?php
/**
 * Created by PhpStorm.
 * User: Polk Farody
 * Date: 3/03/2019
 * Time: 12:14 PM
 */

namespace App\Tests\Domain\Factory;

use App\Domain\Entity\EnterpriseDeliveryOrder;
use App\Domain\Entity\PersonalDeliveryOrder;
use App\Domain\Factory\DeliveryOrderFactory;
use App\Domain\ValueObject\DeliveryType;
use PHPUnit\Framework\TestCase;

class DeliveryOrderFactoryTest extends TestCase {

    protected $deliveryTypes = [];
    protected $factory;

    public function setUp() : void {
        $this->deliveryTypes['enterprise'] = new DeliveryType('enterpriseDelivery');
        $this->deliveryTypes['personal'] = new DeliveryType('personalDelivery');

        $this->factory = new DeliveryOrderFactory();
    }

    public function testCreate() {
        $enterprise_order = $this->factory->create($this->deliveryTypes['enterprise']);
        $this->assertInstanceOf(EnterpriseDeliveryOrder::class, $enterprise_order);

        $personal_order = $this->factory->create($this->deliveryTypes['personal']);
        $this->assertInstanceOf(PersonalDeliveryOrder::class, $personal_order);
    }
}
