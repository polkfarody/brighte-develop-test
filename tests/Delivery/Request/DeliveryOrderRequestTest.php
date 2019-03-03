<?php

namespace App\Tests\Delivery\Request;

use App\Delivery\Factory\DeliveryOrderContainerFactory;
use App\Delivery\Factory\NotifierCollectionFactory;
use App\Delivery\Request\DeliveryOrderRequest;
use App\Delivery\Stub\EnterpriseDeliveryApiStub;
use App\Delivery\Validate\EnterpriseOrderValidator;
use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Factory\DeliveryOrderStrategyFactory;
use App\Tests\DummyJson;
use PHPUnit\Framework\TestCase;

class DeliveryOrderRequestTest extends TestCase {

    public function testGetOrders() {
        $factory = new DeliveryOrderContainerFactory(
            new DeliveryOrderMapperFactory(),
            new NotifierCollectionFactory(),
            new DeliveryOrderStrategyFactory(),
            new EnterpriseOrderValidator(
                new EnterpriseDeliveryApiStub()
            )
        );

        $collection = $factory->create(json_decode(DummyJson::$valid, true));

        $request = new DeliveryOrderRequest($collection);

        $this->assertEquals($collection, $request->getOrders());
    }
}
