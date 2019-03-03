<?php

namespace App\Domain\Mapper;

use App\Domain\Entity\InvoiceInterface;
use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Factory\InvoiceFactory;

class InvoiceMapper implements MapperInterface {

    protected $factory;
    protected $mapperFactory;

    public function __construct(InvoiceFactory $factory, DeliveryOrderMapperFactory $mapperFactory) {
        $this->factory = $factory;
        $this->mapperFactory = $mapperFactory;
    }

    /**
     * @param $object
     * @return array
     * @throws \App\Domain\Exception\InvalidDeliveryTypeException
     */
    public function toArray($object): array {
        $deliveryOrderFactory = $this->mapperFactory->create($object->getDeliveryOrder()->getDeliveryType());
        return [
            'invoiceId' => $object->getId(),
            'invoiceNo' => $object->getInvoiceNo(),
            'deliveryOrder' => $deliveryOrderFactory->toArray($object->getDeliveryOrder()),
            'billingInfo' => $object->getBillingInfo()
        ];
    }

    /**
     * @param array $array
     * @return InvoiceInterface
     * @throws \Exception
     */
    public function toObject(array $array) {
        $deliveryOrder = $this->deliveryOrderFactory->toObject($array['deliveryOrder']);
        return $this->factory->create($deliveryOrder);
    }
}