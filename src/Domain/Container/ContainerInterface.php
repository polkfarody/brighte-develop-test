<?php

namespace App\Domain\Container;

interface ContainerInterface {
    /**
     * Returns a property of the container class.
     * @param string $property
     * @return mixed
     */
    public function get(string $property);
}