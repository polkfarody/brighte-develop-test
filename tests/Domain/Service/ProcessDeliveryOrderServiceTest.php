<?php

namespace Domain\Service;

use App\Delivery\Factory\DeliveryOrderContainerFactory;
use App\Delivery\Factory\NotifierCollectionFactory;
use App\Delivery\Request\DeliveryOrderRequest;
use App\Delivery\Response\JsonDeliveryOrderResponse;
use App\Delivery\Stub\EnterpriseDeliveryApiStub;
use App\Delivery\Validate\EnterpriseOrderValidator;
use App\Domain\Collection\InvoiceArrayCollection;
use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Factory\DeliveryOrderStrategyFactory;
use App\Domain\Factory\InvoiceFactory;
use App\Domain\Mapper\InvoiceMapper;
use App\Domain\Service\ProcessDeliveryOrderService;
use App\Tests\DummyJson;
use PHPUnit\Framework\TestCase;

class ProcessDeliveryOrderServiceTest extends TestCase {

    public function testProcess() {
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

        $response = new JsonDeliveryOrderResponse(
            new InvoiceMapper(
                new InvoiceFactory(),
                new DeliveryOrderMapperFactory()
            )
        );

        $service = new ProcessDeliveryOrderService($request, $response);

        $popResponse = $service->process();

        $this->assertInstanceOf(JsonDeliveryOrderResponse::class, $popResponse);
        $this->assertInstanceOf(InvoiceArrayCollection::class, $popResponse->getInvoices());
        $this->assertJson($popResponse->getJson());
    }
}
