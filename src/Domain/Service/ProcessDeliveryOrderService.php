<?php

namespace App\Domain\Service;

use App\Domain\Collection\InvoiceArrayCollection;
use App\Domain\Request\DeliveryOrderRequestInterface;
use App\Domain\Response\DeliveryOrderResponse;
use App\Domain\Response\DeliveryOrderResponseInterface;

class ProcessDeliveryOrderService {
    /**
     * @var DeliveryOrderRequestInterface
     */
    protected $request;

    /**
     * @var DeliveryOrderResponseInterface
     */
    protected $response;

    public function __construct(DeliveryOrderRequestInterface $request, DeliveryOrderResponseInterface $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function process() : DeliveryOrderResponseInterface {
        $invoices = [];
        foreach ($this->request->getOrders()->getAll() as $orderContainer) {
            $deliveryOrder = $orderContainer->getDeliveryOrder();
            $validator = $orderContainer->getValidator();
            $strategy = $orderContainer->getStrategy();
            $notifiers = $orderContainer->getNotifiers();

            $validator->validate($deliveryOrder);
            $invoices[] = $strategy->generateInvoice($deliveryOrder);

            foreach ($notifiers->getAll() as $notifier) {
                $notifier->notifyObservers();
            }
        }

        $this->response->setInvoices(new InvoiceArrayCollection($invoices));

        return $this->response;
    }
}