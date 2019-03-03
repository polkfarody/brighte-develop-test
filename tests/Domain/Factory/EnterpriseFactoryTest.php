<?php
/**
 * Created by PhpStorm.
 * User: Polk Farody
 * Date: 3/03/2019
 * Time: 12:33 PM
 */

namespace App\Tests\Domain\Factory;

use App\Domain\Entity\Enterprise;
use App\Domain\Factory\EnterpriseFactory;
use PHPUnit\Framework\TestCase;

class EnterpriseFactoryTest extends TestCase {

    public function testCreate() {
        $factory = new EnterpriseFactory();
        $enterprise = $factory->create();

        $this->assertInstanceOf(Enterprise::class, $enterprise);
    }
}
