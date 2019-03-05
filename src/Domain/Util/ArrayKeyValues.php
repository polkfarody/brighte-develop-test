<?php

namespace App\Domain\Util;

use App\Domain\Exception\InvalidKeyLoadedException;
use App\Domain\Exception\InvalidTypeLoadedException;

class ArrayKeyValues {
    public static function validate(array $reqKeys, array $array, callable $iteratedCallback = null) {
        foreach ($reqKeys as $reqKey => $reqType) {
            if (!isset($array[$reqKey])) {
                throw new InvalidKeyLoadedException($reqKey);
            }

            if (gettype($array[$reqKey]) != $reqType) {
                throw new InvalidTypeLoadedException($reqType, $reqKey);
            }

            if (is_callable($iteratedCallback)) {
                $iteratedCallback($reqKey, $array[$reqKey]);
            }
        } 
    }
}