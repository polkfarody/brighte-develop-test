<?php

namespace App\Delivery\Factory;

use App\Delivery\Notifier\EmailCampaignNotifier;
use App\Delivery\Stub\EmailMarketingStub;
use App\Domain\Collection\NotifierArrayCollection;
use App\Domain\Entity\Campaign;

class NotifierCollectionFactory {
    public function create(array $notifiers = []) {
        return new NotifierArrayCollection($notifiers);
    }

    public function extractAndCreate(array $array) : NotifierArrayCollection {
        $notifiers = [];
        if (array_key_exists('campaign', $array)) {
            $notifiers[] = new EmailCampaignNotifier(
                new Campaign($array['campaign']['name'], $array['campaign']['type'], $array['campaign']['ad']),
                new EmailMarketingStub()
            );
        }

        return $this->create($notifiers);
    }
}