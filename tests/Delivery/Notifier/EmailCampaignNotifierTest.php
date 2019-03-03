<?php

namespace App\Tests\Delivery\Notifier;

use App\Delivery\Notifier\EmailCampaignNotifier;
use App\Delivery\Stub\EmailMarketingStub;
use App\Domain\Entity\Campaign;
use PHPUnit\Framework\TestCase;

class EmailCampaignNotifierTest extends TestCase {
    protected $campaignArray = [
        'name' => 'SuperCampaign',
        'type' => 'Holiday',
        'ad' => 'Opportunity'
    ];

    public function testNotifyObservers() {
        $campaign = new Campaign($this->campaignArray['name'], $this->campaignArray['type'], $this->campaignArray['ad']);
        $notifier = new EmailCampaignNotifier(
            $campaign,
            new EmailMarketingStub()
        );

        $notifier->notifyObservers();

        $this->assertTrue($campaign->isNotified());
    }
}
