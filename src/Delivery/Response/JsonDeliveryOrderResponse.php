<?php

namespace App\Delivery\Response;

use App\Domain\Collection\InvoiceArrayCollection;
use App\Domain\Mapper\InvoiceMapper;
use App\Domain\Response\DeliveryOrderResponseInterface;

class JsonDeliveryOrderResponse implements DeliveryOrderResponseInterface {
    protected $mapper;
    public function __construct(InvoiceMapper $mapper) {
        $this->mapper = $mapper;
    }

    protected $invoices;
    public function getInvoices() : InvoiceArrayCollection {
        return $this->invoices;
    }

    public function setInvoices(InvoiceArrayCollection $invoices) {
        $this->invoices = $invoices;
    }

    public function getJSON() {

    }

    public function getData() {
        $data = [];
        foreach ($this->invoices->getAll() as $invoice) {
            $data[] = $this->mapper->toArray($invoice);
        }

        return $data;
    }
}