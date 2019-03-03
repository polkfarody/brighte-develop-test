<?php

namespace Delivery\Response;

use App\Delivery\Response\JsonDeliveryOrderResponse;
use App\Domain\Collection\InvoiceArrayCollection;
use App\Domain\Entity\Invoice;
use App\Domain\Entity\PersonalDeliveryOrder;
use App\Domain\Factory\DeliveryOrderMapperFactory;
use App\Domain\Factory\InvoiceFactory;
use App\Domain\Mapper\InvoiceMapper;
use App\Domain\ValueObject\Contact;
use App\Domain\ValueObject\DeliveryType;
use App\Tests\DummyJson;
use PHPUnit\Framework\TestCase;

class JsonDeliveryOrderResponseTest extends TestCase {

    protected $response;

    public function setUp() : void {
        $this->response = new JsonDeliveryOrderResponse(
            new InvoiceMapper(
                new InvoiceFactory(),
                new DeliveryOrderMapperFactory()
            )
        );

        $invoices = new InvoiceArrayCollection([
            (new Invoice())
                ->setId(022)
                ->setDeliveryOrder(new PersonalDeliveryOrder(
                    new DeliveryType('personalDelivery'),
                    new Contact('Sally', 'Address'),
                    'The Source',
                    300
                ))
        ]);

        $this->response->setInvoices($invoices);
    }

    public function testGetJSON() {
        $json = $this->response->getJson();

        $this->assertJson($json);
        $this->assertJsonStringEqualsJsonString($json, DummyJson::$invoiceJson);
    }

    public function testGetInvoices() {
        $this->assertInstanceOf(InvoiceArrayCollection::class, $this->response->getInvoices());
    }

    public function testGetData() {
        $data = $this->response->getData();

        $this->assertNotEmpty($data);

        $invoice = $data[0];

        $this->assertArrayHasKey('invoiceNo', $invoice);
    }
}
