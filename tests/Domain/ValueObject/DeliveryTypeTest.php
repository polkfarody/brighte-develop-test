<?php

namespace App\Tests\Domain\ValueObject;

use App\Domain\Exception\InvalidDeliveryTypeException;
use App\Domain\ValueObject\DeliveryType;
use PHPUnit\Framework\TestCase;

class DeliveryTypeTest extends TestCase {

    protected $personal_delivery_type = 'personalDelivery';
    protected $express_delivery_type = 'personalDeliveryExpress';
    protected $enterprise_delivery_type = 'enterpriseDelivery';
    protected $invalid_delivery_type = 'invalidDelivery';

    protected $personal = 'personal';
    protected $enterprise = 'enterprise';

    public function testGetType() {
        $delivery_type_personal = new DeliveryType($this->personal_delivery_type);
        $delivery_type_express = new DeliveryType($this->express_delivery_type);
        $delivery_type_enterprise = new DeliveryType($this->enterprise_delivery_type);

        $this->assertEquals('personal', $delivery_type_personal->getType());
        $this->assertEquals('personal', $delivery_type_express->getType());
        $this->assertEquals('enterprise', $delivery_type_enterprise->getType());
    }

    public function testIsExpress() {
        $delivery_type_personal = new DeliveryType($this->personal_delivery_type);
        $delivery_type_express = new DeliveryType($this->express_delivery_type);

        $this->assertTrue($delivery_type_express->isExpress());
        $this->assertFalse($delivery_type_personal->isExpress());
    }

    public function testGetValue() {
        $delivery_type_personal = new DeliveryType($this->personal_delivery_type);
        $delivery_type_express = new DeliveryType($this->express_delivery_type);
        $delivery_type_enterprise = new DeliveryType($this->enterprise_delivery_type);

        $this->assertEquals($this->personal_delivery_type, $delivery_type_personal->getValue());
        $this->assertEquals($this->express_delivery_type, $delivery_type_express->getValue());
        $this->assertEquals($this->enterprise_delivery_type, $delivery_type_enterprise->getValue());
    }

    public function test__construct() {
        // Test valid delivery types.
        $delivery_type = new DeliveryType($this->personal_delivery_type);
        $this->assertEquals($this->personal_delivery_type, $delivery_type->getValue());

        // Test invalid delivery type
        $this->expectException(InvalidDeliveryTypeException::class);
        new DeliveryType($this->invalid_delivery_type);
    }
}
