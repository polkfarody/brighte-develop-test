<?php

namespace App\Tests\Domain\Entity;

use App\Domain\Entity\PersonalDeliveryOrder;
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Contact;
use App\Domain\ValueObject\DeliveryType;

class PersonalDeliveryOrderTest extends TestCase {

    protected $data = [
        'deliveryType' => 'personalDelivery',
        'deliveryTypeObj' => null,
        'customer' => ['name' => 'Pe Dev', 'address' => 'Spark Road Court'],
        'customerObj' => null,
        'source' => 'email',
        'weight' => 300,
        'onBehalf' => 'Behalfman Cat'
    ];

    public function setUp() : void {
        $this->data['deliveryTypeObj'] = new DeliveryType($this->data['deliveryType']);
        $this->data['customerObj'] = new Contact($this->data['customer']['name'], $this->data['customer']['address']);
    }

    /**
     * @test
     */
    public function testSettersGetters() {
        $pdo = new PersonalDeliveryOrder();
        $pdo->setDeliveryType($this->data['deliveryTypeObj'])
            ->setCustomer($this->data['customerObj']) 
            ->setSource($this->data['source'])
            ->setWeight($this->data['weight'])
            ->setOnBehalf($this->data['onBehalf']);

        $this->assertEquals($this->data['deliveryTypeObj'], $pdo->getDeliveryType());
        $this->assertEquals($this->data['customerObj'], $pdo->getCustomer());
        $this->assertEquals($this->data['source'], $pdo->getSource());
        $this->assertEquals($this->data['weight'], $pdo->getWeight());
        $this->assertEquals($this->data['onBehalf'], $pdo->getOnBehalf());
        $this->assertFalse($pdo->isExpress());
    }
}