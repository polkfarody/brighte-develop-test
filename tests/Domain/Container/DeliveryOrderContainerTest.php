<?php

namespace App\Tests\Domain\Container;

use App\Delivery\Stub\EnterpriseDeliveryApiStub;
use App\Domain\Collection\NotifierArrayCollection;
use App\Domain\Container\DeliveryOrderContainer;
use App\Domain\Entity\DeliveryOrderInterface;
use App\Domain\Entity\PersonalDeliveryOrder;
use App\Domain\Factory\InvoiceFactory;
use App\Domain\Strategy\EnterpriseDeliveryOrderStrategy;
use App\Delivery\Validate\EnterpriseOrderValidator;
use PHPUnit\Framework\TestCase;

class DeliveryOrderContainerTest extends TestCase {
    public function testGet() {
        $container = new DeliveryOrderContainer(
            new PersonalDeliveryOrder(),
            new NotifierArrayCollection(),
            new EnterpriseDeliveryOrderStrategy(
                new InvoiceFactory()
            ),
            new EnterpriseOrderValidator(
                new EnterpriseDeliveryApiStub()
            )
        );

        $this->assertInstanceOf(DeliveryOrderInterface::class, $container->get('deliveryOrder'));
        $this->assertInstanceOf(NotifierArrayCollection::class, $container->get('notifiers'));
        $this->assertInstanceOf(EnterpriseDeliveryOrderStrategy::class, $container->get('strategy'));
        $this->assertInstanceOf(EnterpriseOrderValidator::class, $container->get('validator'));
    }
}
