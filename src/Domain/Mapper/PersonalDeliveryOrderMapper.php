<?php

namespace App\Domain\Mapper;

use App\Domain\Entity\PersonalDeliveryOrder;
use App\Domain\Factory\DeliveryOrderFactory;
use App\Domain\Entity\DeliveryOrderInterface;
use App\Domain\ValueObject\Contact;
use App\Domain\ValueObject\DeliveryType;

class PersonalDeliveryOrderMapper implements MapperInterface {

    protected $factory;

    public function __construct(DeliveryOrderFactory $factory) {
        $this->factory = $factory;
    }

    /**
     * @param PersonalDeliveryOrder $object
     * @return array
     */
    public function toArray($object): array {
        $array = [
            'customer' => [
                'name' => $object->getCustomer()->getName(),
                'address' => $object->getCustomer()->getAddress()
            ],
            'deliveryType' => $object->getDeliveryType()->getValue(),
            'source' => $object->getSource(),
            'weight' => $object->getWeight()
        ];

        if ($object->getOnBehalf() !== null) {
            $array['onBehalf'] = $object->getOnBehalf();
        }

        return $array;
    }

    /**
     * @param array $array
     * @return DeliveryOrderInterface
     * @throws \App\Domain\Exception\InvalidDeliveryTypeException
     */
    public function toObject(array $array) {
        return $this->factory->create(new DeliveryType($array['deliveryType']))
            ->setSource($array['source'])
            ->setWeight($array['weight'])
            ->setCustomer(new Contact($array['customer']['name'], $array['customer']['address']))
            ->setOnBehalf($array['onBehalf'] ?? null);
    }
}