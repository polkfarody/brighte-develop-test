<?php

namespace App\Domain\Container;

use App\Domain\Collection\NotifierArrayCollection;
use App\Domain\Entity\DeliveryOrderInterface;
use App\Domain\Strategy\DeliveryOrderStrategyInterface;
use App\Domain\Validate\ValidatorInterface;

class DeliveryOrderContainer implements ContainerInterface {
    /**
     * @var DeliveryOrderInterface
     */
    protected $deliveryOrder;

    /**
     * @var NotifierArrayCollection
     */
    protected $notifiers;

    /**
     * @var DeliveryOrderStrategyInterface
     */
    protected $strategy;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    public function __construct(
        DeliveryOrderInterface $deliveryOrder,
        NotifierArrayCollection $notifiers,
        DeliveryOrderStrategyInterface $strategy,
        ValidatorInterface $validator
    ) {
        $this->deliveryOrder = $deliveryOrder;
        $this->notifiers = $notifiers;
        $this->strategy = $strategy;
        $this->validator = $validator;
    }

    public function get(string $property) {
        if (!property_exists($this, $property)) {
            return false;
        }

        return $this->{$property};
    }

    public function getDeliveryOrder() : DeliveryOrderInterface {
        return $this->deliveryOrder;
    }

    /**
     * @return NotifierArrayCollection
     */
    public function getNotifiers(): NotifierArrayCollection {
        return $this->notifiers;
    }

    /**
     * @return DeliveryOrderStrategyInterface
     */
    public function getStrategy(): DeliveryOrderStrategyInterface {
        return $this->strategy;
    }

    /**
     * @return ValidatorInterface
     */
    public function getValidator(): ValidatorInterface {
        return $this->validator;
    }
}