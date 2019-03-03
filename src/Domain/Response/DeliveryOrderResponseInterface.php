<?php

namespace App\Domain\Response;

use App\Domain\Collection\InvoiceArrayCollection;

interface DeliveryOrderResponseInterface {
    public function setInvoices(InvoiceArrayCollection $invoices);
    public function getInvoices() : InvoiceArrayCollection;
}