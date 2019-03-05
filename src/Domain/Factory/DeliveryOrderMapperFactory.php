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
        $mapper = null;
        switch ($type->getType()) {
            case 'enterprise':
                $mapper = new EnterpriseDeliveryOrderMapper(
                    new DeliveryOrderFactory(),
                    new EnterpriseFactory()
                );
                break;
            case 'personal':
                $mapper = new PersonalDeliveryOrderMapper(
                    new DeliveryOrderFactory()
                );
                break;
        }

        return $mapper;
    }
}