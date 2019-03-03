<?php

namespace App\Domain\Factory;

use App\Domain\Exception\InvalidDeliveryTypeException;
use App\Domain\Mapper\EnterpriseDeliveryOrderMapper;
use App\Domain\Mapper\MapperInterface;
use App\Domain\Mapper\PersonalDeliveryOrderMapper;
use App\Domain\ValueObject\DeliveryType;

/**
 * Class DeliveryOrderMapperFactory
 * @package App\Domain\Factory
 */
class DeliveryOrderMapperFactory {
    public function create(DeliveryType $type) : MapperInterface {
        switch ($type->getType()) {
            case 'enterprise':
                return new EnterpriseDeliveryOrderMapper(
                    new DeliveryOrderFactory(),
                    new EnterpriseFactory()
                );
                break;
            case 'personal':
                return new PersonalDeliveryOrderMapper(
                    new DeliveryOrderFactory()
                );
                break;
        }

        throw new InvalidDeliveryTypeException($type->getType());
    }
}