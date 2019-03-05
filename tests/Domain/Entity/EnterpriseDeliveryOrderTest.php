<?php

namespace App\Tests\Domain\Entity;

use App\Domain\Entity\EnterpriseDeliveryOrder;
use App\Domain\Entity\Enterprise;
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObject\Contact;
use App\Domain\ValueObject\DeliveryType;
use App\Domain\Collection\ContactArrayCollection;

class EnterpriseDeliveryOrderTest extends TestCase {

    protected $data = [
        'deliveryType' => 'enterpriseDelivery',
        'deliveryTypeObj' => null,
        'customer' => ['name' => 'En Dev', 'address' => 'Spark Road Court'],
        'customerObj' => null,
        'source' => 'email',
        'weight' => 300,
        'onBehalf' => 'Gary Trueman',
        'enterprise' => [
        'name' => 'Super Enteprise',
        'type' => 'Super?',
        'abn'  => 'ABN4987594',
            'directors' => [
                ['name' => 'First Last', 'address' => 'Address Lane Street'],
                ['name' => 'Namy McNameFace', 'address' => 'Boat Street']
            ],
            'directorsObj' => null,
            'valid' => false,
        ],
        'enterpriseObj' => null
    ];

    public function setUp() : void {
        $this->data['deliveryTypeObj'] = new DeliveryType($this->data['deliveryType']);
        $this->data['customerObj'] = new Contact($this->data['customer']['name'], $this->data['customer']['address']);

        $this->data['enterprise']['directorsObj'] = new ContactArrayCollection([
            new Contact($this->data['enterprise']['directors'][0]['name'], $this->data['enterprise']['directors'][0]['address']),
            new Contact($this->data['enterprise']['directors'][1]['name'], $this->data['enterprise']['directors'][1]['address'])
        ]);
        
        $this->data['enterpriseObj'] = (new Enterprise())
            ->setName($this->data['enterprise']['name'])
            ->setType($this->data['enterprise']['type'])
            ->setAbn($this->data['enterprise']['abn'])
            ->setDirectors($this->data['enterprise']['directorsObj'])
            ->setValid($this->data['enterprise']['valid']);
    }

    /**
     * @test
     */
    public function testSettersGetters() {
        $edo = new EnterpriseDeliveryOrder();
        $edo->setDeliveryType($this->data['deliveryTypeObj'])
            ->setCustomer($this->data['customerObj']) 
            ->setSource($this->data['source'])
            ->setWeight($this->data['weight'])
            ->setEnterprise($this->data['enterpriseObj'])
            ->setOnBehalf($this->data['onBehalf']);

        $this->assertEquals($this->data['deliveryTypeObj'], $edo->getDeliveryType());
        $this->assertEquals($this->data['customerObj'], $edo->getCustomer());
        $this->assertEquals($this->data['source'], $edo->getSource());
        $this->assertEquals($this->data['weight'], $edo->getWeight());
        $this->assertEquals($this->data['enterpriseObj'], $edo->getEnterprise());
        $this->assertEquals($this->data['onBehalf'], $edo->getOnBehalf());
        $this->assertFalse($edo->isExpress());
    }
}