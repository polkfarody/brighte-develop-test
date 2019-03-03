<?php

namespace App\Domain\Factory;

use App\Domain\Entity\Enterprise;

class EnterpriseFactory {
    /**
     * @return Enterprise
     */
    public function create() : Enterprise {
        return new Enterprise();
    }
}