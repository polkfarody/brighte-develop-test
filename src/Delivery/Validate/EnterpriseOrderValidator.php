<?php

namespace App\Delivery\Validate;

use App\Delivery\Stub\EnterpriseDeliveryApiStub;
use App\Domain\Entity\DeliveryOrderInterface;
use App\Domain\Validate\ValidatorInterface;

class EnterpriseOrderValidator implements ValidatorInterface {
    protected $api;
    public function __construct(EnterpriseDeliveryApiStub $api) {
        $this->api = $api;
    }

    public function validate(DeliveryOrderInterface $object) : bool {
        if ($object->getDeliveryType()->getType() !== 'enterprise') {
            return false;
        }

        $this->api->setPayload($object->getEnterprise());
        $value = $this->api->send();

        $object->getEnterprise()->setValid($value);

        return $object->getEnterprise()->isValid();
    }
}