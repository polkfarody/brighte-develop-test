<?php

namespace App\Domain\Factory;

use App\Domain\Entity\DeliveryOrderInterface;
use App\Domain\Entity\PersonalDeliveryOrder;
use App\Domain\Entity\EnterpriseDeliveryOrder;
use App\Domain\Exception\InvalidDeliveryTypeException;
use App\Domain\ValueObject\DeliveryType;

/**
 * Class DeliveryOrderFactory
 * @package App\Domain\Factory
 */
class DeliveryOrderFactory {
    /**
     * Returns a DeliveryOrder based on specified DeliveryType
     * @param DeliveryType $type
     * @return DeliveryOrderInterface
     */
    public function create(DeliveryType $type) : DeliveryOrderInterface {
        $order = null;
        switch ($type->getType()) {
            case 'enterprise':
                $order = new EnterpriseDeliveryOrder($type);
                break;
            case 'personal':
                $order = new PersonalDeliveryOrder($type);
                break;
        }

        return $order;
    }
}