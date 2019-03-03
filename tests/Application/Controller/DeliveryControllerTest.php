<?php

namespace Tests\Application\Controller;

use App\Controller\DeliveryController;
use App\Delivery\Stub\EnterpriseDeliveryApiStub;
use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Factory\DeliveryOrderStrategyFactory;
use App\Delivery\Factory\DeliveryOrderContainerFactory;
use App\Delivery\Factory\NotifierCollectionFactory;
use App\Tests\DummyJson;
use App\Delivery\Validate\EnterpriseOrderValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeliveryControllerTest extends TestCase {
    protected $controller;
    public function setUp() : void {
        $this->controller = new DeliveryController(new DeliveryOrderContainerFactory(
            new DeliveryOrderMapperFactory(),
            new NotifierCollectionFactory(),
            new DeliveryOrderStrategyFactory(),
            new EnterpriseOrderValidator(
                new EnterpriseDeliveryApiStub()
            )
        ));
    }

    public function testSuccessfulProcess() {
        $request = Request::create(
            '/delivery/process', // URI
            'POST', // Method
            [], // Params
            [], // Cookies
            [], // Files
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_CONTENT_TYPE' => 'application/json'
            ], // Server
            DummyJson::$valid // Finally Content.
        );

        $response = $this->controller->process($request);

        var_dumP($response); exit;

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }

    public function testProcessWithNoJson() {
        $request = new Request();

        $response = $this->controller->process($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
