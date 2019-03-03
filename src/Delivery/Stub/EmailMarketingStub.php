<?php

namespace App\Delivery\Stub;

use App\Delivery\Provider\ApiProviderInterface;
use App\Domain\Entity\Campaign;

/**
 * This class is only to allow the code to continue and show the functionality can exist.
 * Class EmailMarketingStub
 * @package App\Domain\Stub
 */
class EmailMarketingStub implements ApiProviderInterface {
    protected $campaign;

    /**
     * @param Campaign $campaign
     */
    public function setPayload($campaign) {
        $this->campaign = $campaign;
    }

    public function send() {
        return true;
    }
}