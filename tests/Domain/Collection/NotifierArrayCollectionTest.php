<?php
/**
 * Created by PhpStorm.
 * User: Polk Farody
 * Date: 3/03/2019
 * Time: 12:51 PM
 */

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
