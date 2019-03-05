<?php

namespace App\Tests\Domain\Entity;

use App\Domain\Entity\Campaign;
use PHPUnit\Framework\TestCase;
use App\Domain\Exception\InvalidKeyLoadedException;
use App\Domain\Exception\InvalidTypeLoadedException;

class CampaignTest extends TestCase {
    protected $data = [
        'name' => 'The Campaign',
        'type' => 'Super Type',
        'ad'   => 'The One Ad Rodeo'
    ];  

    public function test__construct() {
        $campaign = new Campaign(
            $this->data['name'],
            $this->data['type'],
            $this->data['ad']
        );

        $this->assertEquals($this->data['name'], $campaign->getName());
        $this->assertEquals($this->data['type'], $campaign->getType());
        $this->assertEquals($this->data['ad'], $campaign->getAd());

        $this->assertFalse($campaign->isNotified());

        $campaign->setNotified(true);

        $this->assertTrue($campaign->isNotified());
    }

    public function testLoad() {
        $campaign = new Campaign();
        $campaign->load($this->data);   

        $this->assertEquals($this->data['name'], $campaign->getName());
        $this->assertEquals($this->data['type'], $campaign->getType());
        $this->assertEquals($this->data['ad'], $campaign->getAd());  
    }

    public function testEmptyLoad() {
        $campaign = new Campaign();
        $this->expectException(InvalidKeyLoadedException::class);
        $campaign->load([]);
    }

    /**
     * @test
     */
    public function testInvalidTypeLoad() {
        $campaign = new Campaign();
        $this->expectException(InvalidTypeLoadedException::class);
        $fake_array = array_merge($this->data, ['name' => new \stdClass()]);
        $campaign->load($fake_array);
    }

    /**
     * @test
     */
    public function testSetters() {
        $campaign = new Campaign();

        $this->assertNull($campaign->getName());
        $this->assertNull($campaign->getType());
        $this->assertNull($campaign->getAd());

        $campaign->setName($this->data['name'])
                 ->setType($this->data['type'])
                 ->setAd($this->data['ad']);

        $this->assertEquals($this->data['name'], $campaign->getName());
        $this->assertEquals($this->data['type'], $campaign->getType());
        $this->assertEquals($this->data['ad'], $campaign->getAd()); 
    }
}