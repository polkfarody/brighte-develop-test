<?php

namespace App\Delivery\Stub;

use App\Delivery\Provider\ApiProviderInterface;
use App\Domain\Entity\Enterprise;

/**
 * This class is only to allow the code to continue and show the functionality can exist.
 * Class EnterpriseDeliveryApiStub
 * @package App\Domain\Stub
 */
class EnterpriseDeliveryApiStub implements ApiProviderInterface {
    protected $enterprise;

    /**
     * @param Enterprise $enterprise
     */
    public function setPayload($enterprise) {
        $this->enterprise = $enterprise;
    }

    /**
     * This method would normally send an API request to somewhere.
     */
    public function send() {
        // Do some actions with $this->enterprise
        return true;
    }
}