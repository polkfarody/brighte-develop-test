<?php
/**
 * Created by PhpStorm.
 * User: Polk Farody
 * Date: 3/03/2019
 * Time: 1:35 PM
 */

namespace App\Tests\Domain\Mapper;

use App\Domain\Entity\PersonalDeliveryOrder;
use App\Domain\Factory\DeliveryOrderFactory;
use App\Domain\Mapper\PersonalDeliveryOrderMapper;
use App\Domain\ValueObject\Contact;
use App\Domain\ValueObject\DeliveryType;
use PHPUnit\Framework\TestCase;

class PersonalDeliveryOrderMapperTest extends TestCase {
    protected $mapper = null;
    protected $orderArray = [
        'customer' => [
            'name' => 'Betty Davis',
            'address' => '6 Davis Lane'
        ],
        'deliveryType' => 'personalDelivery',
        'source' => 'email',
        'onBehalf' => 'Seaborn Industries',
        'weight' => 300
    ];

    protected $orderObject;

    /**
     * @throws \App\Domain\Exception\InvalidDeliveryTypeException
     */
    public function setUp() : void {
        $this->mapper = new PersonalDeliveryOrderMapper(
            new DeliveryOrderFactory()
        );

        $this->orderObject = new PersonalDeliveryOrder(
            new DeliveryType($this->orderArray['deliveryType']),
            new Contact($this->orderArray['customer']['name'], $this->orderArray['customer']['address']),
            $this->orderArray['source'],
            $this->orderArray['weight'],
            $this->orderArray['onBehalf']
        );
    }

    public function testToArray() {
        $orderArray = $this->mapper->toArray($this->orderObject);

        // The mapper should map the order back to the order array property
        $this->assertEquals($this->orderArray, $orderArray);
    }

    public function testToObject() {
        $orderObject = $this->mapper->toObject($this->orderArray);

        $this->assertInstanceOf(PersonalDeliveryOrder::class, $orderObject);

        $this->assertEquals($this->orderObject, $orderObject);

    }

    public function testWithoutOnBehalf() {
        $orderArray = $this->orderArray;
        unset($orderArray['onBehalf']);

        $orderObject = $this->mapper->toObject($orderArray);

        $this->assertInstanceOf(PersonalDeliveryOrder::class, $orderObject);
        $this->assertNull($orderObject->getOnBehalf());

        $orderArray = $this->mapper->toArray($orderObject);
        $this->assertArrayNotHasKey('onBehalf', $orderArray);
    }
}
