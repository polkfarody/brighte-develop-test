<?php

namespace App\Tests\Delivery\Factory;

use App\Delivery\Factory\NotifierCollectionFactory;
use App\Domain\Collection\NotifierArrayCollection;
use PHPUnit\Framework\TestCase;

class NotifierCollectionFactoryTest extends TestCase {
    protected $campaign = [
        'campaign' => [
            'name' => 'The Campaign',
            'type' => 'The Type',
            'ad' => '1994 Ad from 90s'
        ]
    ];

    protected $factory;

    public function setUp() :void {
        $this->factory = new NotifierCollectionFactory();
    }

    public function testExtractAndCreate() {
        $collection = $this->factory->extractAndCreate($this->campaign);

        $this->assertInstanceOf(NotifierArrayCollection::class, $collection);
        $this->assertNotEmpty($collection->getAll());
    }
}
