<?php

namespace App\Delivery\Provider;

interface ApiProviderInterface {
    public function setPayload($object);
    public function send();
}