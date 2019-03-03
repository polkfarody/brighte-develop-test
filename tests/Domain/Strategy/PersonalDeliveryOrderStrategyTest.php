<?php
/**
 * Created by PhpStorm.
 * User: Polk Farody
 * Date: 3/03/2019
 * Time: 3:10 PM
 */

namespace App\Tests\Domain\Strategy;

use App\Domain\Entity\Invoice;
use App\Domain\Entity\PersonalDeliveryOrder;
use App\Domain\Factory\InvoiceFactory;
use App\Domain\Strategy\PersonalDeliveryOrderStrategy;
use PHPUnit\Framework\TestCase;

class PersonalDeliveryOrderStrategyTest extends TestCase {

    public function testGenerateInvoice() {
        $strategy = new PersonalDeliveryOrderStrategy(
            new InvoiceFactory()
        );

        $order = $this->getMockBuilder(PersonalDeliveryOrder::class);

        $invoice = $strategy->generateInvoice($order->getMock());

        $this->assertInstanceOf(Invoice::class, $invoice);
        $this->assertGreaterThan(0, $invoice->getId());
        $this->assertInstanceOf(PersonalDeliveryOrder::class, $invoice->getDeliveryOrder());
    }
}
