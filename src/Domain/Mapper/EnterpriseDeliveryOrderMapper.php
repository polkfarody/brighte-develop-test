<?php

namespace App\Domain\Mapper;

use App\Domain\Entity\EnterpriseDeliveryOrder;
use App\Domain\Factory\DeliveryOrderFactory;
use App\Domain\Factory\EnterpriseFactory;
use App\Domain\ValueObject\Contact;
use App\Domain\ValueObject\DeliveryType;

class EnterpriseDeliveryOrderMapper implements MapperInterface {

    protected $factory;
    protected $enterpriseFactory;

    public function __construct(DeliveryOrderFactory $factory, EnterpriseFactory $enterpriseFactory) {
        $this->factory = $factory;
        $this->enterpriseFactory = $enterpriseFactory;
    }

    /**
     * @param EnterpriseDeliveryOrder $object
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
            'weight' => $object->getWeight(),
            'enterprise' => $object->getEnterprise()->unload()
        ];

        if ($object->getOnBehalf() !== null) {
            $array['onBehalf'] = $object->getOnBehalf();
        }

        return $array;
    }

    /**
     * @param array $array
     * @return EnterpriseDeliveryOrder
     * @throws \App\Domain\Exception\InvalidDeliveryTypeException
     */
    public function toObject(array $array) {
        return $this->factory->create(new DeliveryType($array['deliveryType']))
            ->setSource($array['source'])
            ->setWeight($array['weight'])
            ->setCustomer(new Contact($array['customer']['name'], $array['customer']['address']))
            ->setEnterprise($this->enterpriseFactory->create()->load($array['enterprise']))
            ->setOnBehalf($array['onBehalf'] ?? null);
    }

}