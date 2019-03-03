<?php

namespace App\Domain\Notifier;

interface NotifierObjectInterface {
    public function setNotified(bool $notified) : NotifierObjectInterface;
    public function isNotified() : bool;
}