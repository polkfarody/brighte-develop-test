<?php

namespace App\Tests\Domain\Mapper;

use App\Domain\Mapper\InvoiceMapper;
use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Factory\InvoiceFactory;
use App\Domain\ValueObject\DeliveryType;
use App\Domain\Entity\Invoice;
use PHPUnit\Framework\TestCase;
use App\Domain\Exception\InvalidDeliveryTypeException;

class InvoiceMapperTest extends TestCase {
    protected $invoiceArr = [
        'invoiceId' => 1,
        'invoiceNo' => 'INV0000000001',
        'deliveryOrder' => [
            'deliveryType' => 'enterpriseDelivery',
            'customer' => ['name' => 'En Dev', 'address' => 'Spark Road Court'],
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
                'valid' => false,
            ]
        ],
        'billingInfo' => 'Spark Road Court'
    ];

    protected $invoiceObj = null;

    public function setUp() : void {
        $deliveryType = new DeliveryType($this->invoiceArr['deliveryOrder']['deliveryType']);

        $doMapper = (new DeliveryOrderMapperFactory())
            ->create($deliveryType);

        $deliveryOrder = $doMapper->toObject($this->invoiceArr['deliveryOrder']);

        $this->invoiceObj = (new Invoice())
            ->setId($this->invoiceArr['invoiceId'])
            ->setDeliveryOrder($deliveryOrder);
    }

    /**
     * @test
     */
    public function testToArray() {
        $mapper = new InvoiceMapper(
            new InvoiceFactory(),
            new DeliveryOrderMapperFactory(),
        );  

        $invoiceArr = $mapper->toArray($this->invoiceObj);
        $this->assertEquals($this->invoiceArr, $invoiceArr);
    }

    /**
     * @test
     */
    public function testToObject() {
        $mapper = new InvoiceMapper(
            new InvoiceFactory(),
            new DeliveryOrderMapperFactory(),
        );

        $invoiceObj = $mapper->toObject($this->invoiceArr);
        $this->assertEquals($this->invoiceObj, $invoiceObj);  
    }

    /**
     * @test
     */
    public function testToObjectInvalidDeliveryType() {
        $mapper = new InvoiceMapper(
            new InvoiceFactory(),
            new DeliveryOrderMapperFactory(),
        );

        // Change delivery type to one that doesn't exist.
        $this->invoiceArr['deliveryOrder']['deliveryType'] = 'fakeType';

        $this->expectException(InvalidDeliveryTypeException::class);
        $invoiceObj = $mapper->toObject($this->invoiceArr);
    }
}