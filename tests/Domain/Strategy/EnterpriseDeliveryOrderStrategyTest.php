<?php

namespace App\Tests\Domain\Strategy;

use App\Domain\Entity\EnterpriseDeliveryOrder;
use App\Domain\Entity\Invoice;
use App\Domain\Factory\InvoiceFactory;
use App\Domain\Strategy\EnterpriseDeliveryOrderStrategy;
use PHPUnit\Framework\TestCase;

class EnterpriseDeliveryOrderStrategyTest extends TestCase {

    public function testGenerateInvoice() {
        $strategy = new EnterpriseDeliveryOrderStrategy(
            new InvoiceFactory()
        );

        $order = $this->getMockBuilder(EnterpriseDeliveryOrder::class);

        $invoice = $strategy->generateInvoice($order->getMock());

        $this->assertInstanceOf(Invoice::class, $invoice);
        $this->assertGreaterThan(0, $invoice->getId());
        $this->assertInstanceOf(EnterpriseDeliveryOrder::class, $invoice->getDeliveryOrder());
    }
}
