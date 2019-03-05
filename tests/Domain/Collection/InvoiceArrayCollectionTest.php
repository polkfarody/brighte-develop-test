<?php

namespace Tests;

use App\Domain\Collection\InvoiceArrayCollection;
use PHPUnit\Framework\TestCase;

class InvoiceArrayCollectionTest extends TestCase {
    /**
     * Tests the type of object in the items array.
     */
    public function test__construct() {
        $this->expectException(\InvalidArgumentException::class);
        new InvoiceArrayCollection([
            (new Class {}),
            (new Class {})
        ]);
    }
}