<?php

namespace App\Domain\Mapper;

interface MapperInterface {
    public function toArray($object) : array;
    public function toObject(array $array);
}
