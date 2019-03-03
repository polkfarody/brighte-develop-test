<?php

namespace Factory;

use App\Delivery\Stub\EnterpriseDeliveryApiStub;
use App\Domain\Collection\DeliveryOrderContainerArrayCollection;
use App\Domain\Exception\InvalidDeliveryTypeException;
use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Factory\DeliveryOrderStrategyFactory;
use App\Delivery\Factory\DeliveryOrderContainerFactory;
use App\Delivery\Factory\NotifierCollectionFactory;
use App\Delivery\Validate\EnterpriseOrderValidator;
use PHPUnit\Framework\TestCase;
use App\Tests\DummyJson;

class DeliveryOrderContainerFactoryTest extends TestCase {
    protected $factory;

    protected function setUp() : void {
        parent::setUp();

        $this->factory = new DeliveryOrderContainerFactory(
            new DeliveryOrderMapperFactory(),
            new NotifierCollectionFactory(),
            new DeliveryOrderStrategyFactory(),
            new EnterpriseOrderValidator(
                new EnterpriseDeliveryApiStub()
            )
        );
    }

    public function testCreate() {
        $valid_data = json_decode(DummyJson::$valid, true);
        $invalid_data = json_decode(DummyJson::$invalid, true);

        $container = $this->factory->create($valid_data);
        $this->assertInstanceOf(DeliveryOrderContainerArrayCollection::class, $container);

        $collection =  $this->factory->create([]);
        $this->assertInstanceOf(DeliveryOrderContainerArrayCollection::class, $collection);

        $this->expectException(InvalidDeliveryTypeException::class);
        $this->factory->create($invalid_data);
    }
}
