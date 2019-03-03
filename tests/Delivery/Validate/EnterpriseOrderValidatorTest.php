<?php

namespace App\Tests\Delivery\Validate;

use App\Delivery\Stub\EnterpriseDeliveryApiStub;
use App\Delivery\Validate\EnterpriseOrderValidator;
use App\Domain\Entity\Enterprise;
use App\Domain\Entity\EnterpriseDeliveryOrder;
use App\Domain\ValueObject\DeliveryType;
use PHPUnit\Framework\TestCase;

class EnterpriseOrderValidatorTest extends TestCase {

    public function testValidate() {
        $validator = new EnterpriseOrderValidator(
            new EnterpriseDeliveryApiStub()
        );

        $order = new EnterpriseDeliveryOrder(new DeliveryType('enterpriseDelivery'));
        $order->setEnterprise(new Enterprise());
        $result = $validator->validate($order);

        $this->assertTrue($result);
    }
}
