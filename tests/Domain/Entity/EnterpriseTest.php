<?php

namespace App\Tests\Domain\Entity;

use App\Domain\Entity\Enterprise;
use PHPUnit\Framework\TestCase;
use App\Domain\Collection\ContactArrayCollection;
use App\Domain\ValueObject\Contact;
use App\Domain\Exception\InvalidKeyLoadedException;
use App\Domain\Exception\InvalidTypeLoadedException;

class EnterpriseTest extends TestCase {

    protected $data = [
        'name' => 'Super Enteprise',
        'type' => 'Super?',
        'abn'  => 'ABN4987594',
        'directors' => [
            ['name' => 'First Last', 'address' => 'Address Lane Street'],
            ['name' => 'Namy McNameFace', 'address' => 'Boat Street']
        ],
        'directorsObj' => null,
        'valid' => false,
    ];

    public function setUp() : void {
        $this->data['directorsObj'] = new ContactArrayCollection([
            new Contact($this->data['directors'][0]['name'], $this->data['directors'][0]['address']),
            new Contact($this->data['directors'][1]['name'], $this->data['directors'][1]['address'])
        ]);
    }

    /**
     * @test
     */
    public function testSettersGetters() {
        $enterprise = new Enterprise();

        $enterprise->setName($this->data['name'])
                   ->setType($this->data['type'])
                   ->setAbn($this->data['abn'])
                   ->setDirectors($this->data['directorsObj'])
                   ->setValid($this->data['valid']);

        $this->assertEquals($this->data['name'], $enterprise->getName());
        $this->assertEquals($this->data['type'], $enterprise->getType());
        $this->assertEquals($this->data['abn'], $enterprise->getAbn());
        $this->assertEquals($this->data['directorsObj'], $enterprise->getDirectors());
        $this->assertEquals($this->data['valid'], $enterprise->isValid());
    }

    public function testLoad() {
        $enterprise = new Enterprise();
        $enterprise->load($this->data);   

        $this->assertEquals($this->data['name'], $enterprise->getName());
        $this->assertEquals($this->data['type'], $enterprise->getType());
        $this->assertEquals($this->data['abn'], $enterprise->getAbn());
        $this->assertEquals($this->data['directorsObj'], $enterprise->getDirectors());
        $this->assertEquals($this->data['valid'], $enterprise->isValid());  
    }

    public function testEmptyLoad() {
        $enterprise = new Enterprise();
        $this->expectException(InvalidKeyLoadedException::class);
        $enterprise->load([]);
    }

    /**
     * @test
     */
    public function testInvalidTypeLoad() {
        $enterprise = new Enterprise();
        $this->expectException(InvalidTypeLoadedException::class);
        $fake_array = array_merge($this->data, ['name' => new \stdClass()]);
        $enterprise->load($fake_array);
    }
}