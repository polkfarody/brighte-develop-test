<?php

namespace App\Delivery\Factory;

use App\Domain\Collection\DeliveryOrderContainerArrayCollection;
use App\Domain\Container\DeliveryOrderContainer;
use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Factory\DeliveryOrderStrategyFactory;
use App\Domain\Validate\ValidatorInterface;
use App\Domain\ValueObject\DeliveryType;

/**
 * A
 * Class DeliveryOrderServiceFactory
 * @package App\Factory
 */
class DeliveryOrderContainerFactory {
    /**
     * @var DeliveryOrderMapperFactory
     */
    protected $mapperFactory;
    protected $notifierFactory;
    protected $strategyFactory;
    protected $validator;

    public function __construct(
        DeliveryOrderMapperFactory $mapperFactory,
        NotifierCollectionFactory $notifierFactory,
        DeliveryOrderStrategyFactory $strategyFactory,
        ValidatorInterface $validator
    ) {
        $this->mapperFactory = $mapperFactory;
        $this->notifierFactory = $notifierFactory;
        $this->strategyFactory = $strategyFactory;
        $this->validator = $validator;
    }

    /**
     * @param array $orders
     * @return DeliveryOrderContainerArrayCollection
     * @throws \App\Domain\Exception\InvalidDeliveryTypeException
     */
    public function create(array $orders) : DeliveryOrderContainerArrayCollection {
        $containers = [];
        foreach ($orders as $order) {
            $delivery_type = new DeliveryType($order['deliveryType']);
            $containers[] = new DeliveryOrderContainer(
                $this->mapperFactory->create($delivery_type)->toObject($order),
                $this->notifierFactory->extractAndCreate($order),
                $this->strategyFactory->create($delivery_type),
                $this->validator
            );
        }

        return new DeliveryOrderContainerArrayCollection($containers);
    }
}