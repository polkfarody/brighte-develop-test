<?php

/**
 * This script processes the dummy delivery order data and
 * returns and array of generated invoices.
 */

require_once __DIR__ . '../vendor/autoload.php';

// Create delivery order containers
$factory = new \App\Delivery\Factory\DeliveryOrderContainerFactory(
    new \App\Domain\Factory\DeliveryOrderMapperFactory(),
    new \App\Delivery\Factory\NotifierCollectionFactory(),
    new \App\Domain\Factory\DeliveryOrderStrategyFactory(),
    new \App\Delivery\Validate\EnterpriseOrderValidator(
        new \App\Delivery\Stub\EnterpriseDeliveryApiStub()
    )
);



$collection = $factory->create(json_decode(\App\Tests\DummyJson::$valid, true));

$service = new \App\Domain\Service\ProcessDeliveryOrderService(
    new \App\Delivery\Request\DeliveryOrderRequest($collection),
    new \App\Delivery\Response\JsonDeliveryOrderResponse(new \App\Domain\Mapper\InvoiceMapper(
        new \App\Domain\Factory\InvoiceFactory(),
        new \App\Domain\Factory\DeliveryOrderMapperFactory()
    ))
);

$response = $service->process();

print($response->getJson());