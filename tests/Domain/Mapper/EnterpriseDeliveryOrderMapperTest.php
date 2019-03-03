<?php
/**
 * Created by PhpStorm.
 * User: Polk Farody
 * Date: 3/03/2019
 * Time: 12:55 PM
 */

namespace App\Tests\Domain\Mapper;

use App\Domain\Collection\ContactArrayCollection;
use App\Domain\Entity\Enterprise;
use App\Domain\Entity\EnterpriseDeliveryOrder;
use App\Domain\Factory\DeliveryOrderFactory;
use App\Domain\Factory\EnterpriseFactory;
use App\Domain\Mapper\EnterpriseDeliveryOrderMapper;
use App\Domain\ValueObject\Contact;
use App\Domain\ValueObject\DeliveryType;
use PHPUnit\Framework\TestCase;

class EnterpriseDeliveryOrderMapperTest extends TestCase {

    protected $orderArray = [
        'customer' => [
            'name' => 'Betty Davis',
            'address' => '6 Davis Lane'
        ],
        'deliveryType' => 'enterpriseDelivery',
        'source' => 'email',
        'onBehalf' => 'Seaborn Industries',
        'weight' => 300,
        'enterprise' => [
            'name' => 'Business Names Are Us',
            'type' => 'PTYLTD',
            'abn' => 'ABN398547398',
            'directors' => [
                [
                    'name' => 'John Director',
                    'address' => '21 Direct Lane'
                ],
                [
                    'name' => 'Mary Director',
                    'address' => '44 Director Boulevard'
                ]
            ],
            'valid' => 0
        ]
    ];

    protected $orderObject;

    protected $mapper;

    /**
     * @throws \App\Domain\Exception\InvalidDeliveryTypeException
     */
    public function setUp() : void {
        $this->mapper = new EnterpriseDeliveryOrderMapper(
            new DeliveryOrderFactory(),
            new EnterpriseFactory()
        );

        $this->orderObject = new EnterpriseDeliveryOrder(
            new DeliveryType($this->orderArray['deliveryType']),
            new Contact($this->orderArray['customer']['name'], $this->orderArray['customer']['address']),
            $this->orderArray['source'],
            $this->orderArray['weight'],
            new Enterprise(
                $this->orderArray['enterprise']['name'],
                $this->orderArray['enterprise']['type'],
                $this->orderArray['enterprise']['abn'],
                new ContactArrayCollection([
                    new Contact($this->orderArray['enterprise']['directors'][0]['name'], $this->orderArray['enterprise']['directors'][0]['address']),
                    new Contact($this->orderArray['enterprise']['directors'][1]['name'], $this->orderArray['enterprise']['directors'][1]['address']),
                ])
            ),
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

        $this->assertInstanceOf(EnterpriseDeliveryOrder::class, $orderObject);

        $this->assertEquals($this->orderObject, $orderObject);
    }

    public function testWithoutOnBehalf() {
        $orderArray = $this->orderArray;
        unset($orderArray['onBehalf']);

        $orderObject = $this->mapper->toObject($orderArray);

        $this->assertInstanceOf(EnterpriseDeliveryOrder::class, $orderObject);
        $this->assertNull($orderObject->getOnBehalf());

        $orderArray = $this->mapper->toArray($orderObject);
        $this->assertArrayNotHasKey('onBehalf', $orderArray);
    }
}
