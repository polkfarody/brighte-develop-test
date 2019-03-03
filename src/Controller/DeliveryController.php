<?php

namespace App\Controller;

use App\Delivery\Factory\DeliveryOrderContainerFactory;
use App\Delivery\Request\DeliveryOrderRequest;
use App\Delivery\Response\JsonDeliveryOrderResponse;
use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Factory\InvoiceFactory;
use App\Domain\Mapper\InvoiceMapper;
use App\Domain\Service\ProcessDeliveryOrderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractDelivery
 * @package App\Controller
 */
class DeliveryController extends AbstractController {

    private $factory;

    public function __construct(DeliveryOrderContainerFactory $factory) {
        $this->factory = $factory;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Domain\Exception\InvalidDeliveryTypeException
     */
    public function process(Request $request) : JsonResponse {
        $response = new JsonResponse();
        
        if ($request->getContentType() == 'application/json' || !$request->getContent()) {
            return $response->setStatusCode(Response::HTTP_BAD_REQUEST)
                 ->setData([
                     'status'  => 'failed',
                     'message' => 'Invalid content type provided'
                 ]);
        }

        // Create delivery order containers
        $collection = $this->factory->create(json_decode($request->getContent(), true));

        $service = new ProcessDeliveryOrderService(
            new DeliveryOrderRequest($collection),
            new JsonDeliveryOrderResponse(new InvoiceMapper(
                new InvoiceFactory(),
                new DeliveryOrderMapperFactory()
            ))
        );

        return $response->setStatusCode(Response::HTTP_OK)
            ->setData([
                'status' => 'success',
                'message' => 'Deliveries processed successfully',
                'invoices' => $service->process()->getData()
            ]);
    }
}
