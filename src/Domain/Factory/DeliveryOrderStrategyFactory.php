<?php

namespace App\Domain\Factory;

use App\Domain\Exception\InvalidDeliveryTypeException;
use App\Domain\Strategy\DeliveryOrderStrategyInterface;
use App\Domain\Strategy\EnterpriseDeliveryOrderStrategy;
use App\Domain\Strategy\PersonalDeliveryOrderStrategy;
use App\Domain\ValueObject\DeliveryType;

class DeliveryOrderStrategyFactory {
    /**
     * @param DeliveryType $type
     * @return DeliveryOrderStrategyInterface
     * @throws InvalidDeliveryTypeException
     */
    public function create(DeliveryType $type) : DeliveryOrderStrategyInterface {
        $strategy = null;
        switch ($type->getType()) {
            case 'personal':
                $strategy = new PersonalDeliveryOrderStrategy(
                    new InvoiceFactory()
                );
                break;
            case 'enterprise':
                $strategy = new EnterpriseDeliveryOrderStrategy(
                    new InvoiceFactory()
                );
                break;
        }

        return $strategy;
    }
}