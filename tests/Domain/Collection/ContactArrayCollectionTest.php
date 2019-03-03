<?php

namespace Domain\Collection;

use App\Domain\Collection\ContactArrayCollection;
use App\Domain\ValueObject\Contact;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class ContactArrayCollectionTest extends TestCase {
    /**
     * Test that correct exception was thrown when invalid types are passed.
     */
    public function testException() {
        $this->expectException(InvalidArgumentException::class);

        new ContactArrayCollection([new \stdClass()]);
    }

    /**
     * Test that the items array was set to items in the constructor
     */
    public function test__construct() {
        $items = [new Contact('Person Name', 'Person Address')];

        $collection = new ContactArrayCollection($items);

        $this->assertEquals($items, $collection->getAll());
    }
}
