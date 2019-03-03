<?php

namespace App\Delivery\Notifier;

use App\Domain\Entity\Campaign;
use App\Domain\Notifier\NotifierInterface;
use App\Delivery\Provider\ApiProviderInterface;

class EmailCampaignNotifier implements NotifierInterface {
    /**
     * @var ApiProviderInterface
     */
    protected $api;

    /**
     * @var Campaign
     */
    protected $campaign;

    /**
     * EmailCampaignNotifier constructor.
     * @param Campaign $campaign
     * @param ApiProviderInterface $api
     */
    public function __construct(
        Campaign $campaign,
        ApiProviderInterface $api
    ) {
        $this->campaign = $campaign;
        $this->api = $api;
    }

    public function notifyObservers(): void {
        $this->api->setPayload($this->campaign);
        $this->campaign->setNotified($this->api->send());
    }
}