<?php

namespace App\Tests\Domain\Collection;

use App\Domain\Collection\NotifierArrayCollection;
use PHPUnit\Framework\TestCase;

class NotifierArrayCollectionTest extends TestCase {
    public function test__construct() {
        $this->expectException(\InvalidArgumentException::class);
        new NotifierArrayCollection([
            (new Class {}),
            (new Class {})
        ]);
    }
}
