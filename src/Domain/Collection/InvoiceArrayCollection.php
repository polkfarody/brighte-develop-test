<?php

namespace App\Domain\Collection;

use App\Domain\Entity\InvoiceInterface;
use InvalidArgumentException;

class InvoiceArrayCollection extends ArrayCollection {
    /**
     * InvoiceArrayCollection constructor.
     * @param array $invoices
     */
    public function __construct(array $invoices = []) {
        foreach ($invoices as $invoice) {
            if (!$invoice instanceof InvoiceInterface) {
                throw new InvalidArgumentException('Invoice must be an instance of InvoiceInterface');
            }
        }

        parent::__construct($invoices);
    }
}