<?php
/**
 * Created by PhpStorm.
 * User: Polk Farody
 * Date: 27/02/2019
 * Time: 10:30 PM
 */

namespace Domain\Collection;

use App\Domain\Collection\ArrayCollection;
use App\Domain\Collection\CollectionInterface;
use PHPUnit\Framework\TestCase;

class ArrayCollectionTest extends TestCase {
    protected $items  = ['item', 1, 2];

    protected $fullCollection;
    protected $emptyCollection;

    /**
     * Pre-fill the collections
     */
    public function setUp() : void {
        $this->fullCollection = new ArrayCollection($this->items);
        $this->emptyCollection = new ArrayCollection([]);
    }

    /**
     * Test the clear method clears the items array
     */
    public function testClear() {
        $this->fullCollection->clear();

        $this->assertEmpty($this->fullCollection->getAll());
        $this->assertEquals(0, $this->fullCollection->length());
    }

    /**
     * Test the length method corresponds with the count of initial items.
     */
    public function testLength() {
        $this->assertEquals(count($this->items), $this->fullCollection->length());
        $this->assertEquals(0, $this->emptyCollection->length());
    }

    /**
     * Test the getAll method returns the same array it was passed.
     */
    public function testGetAll() {
        $this->assertEquals($this->items, $this->fullCollection->getAll());
        $this->assertEquals([], $this->emptyCollection->getAll());
    }
}
