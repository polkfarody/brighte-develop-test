<?php

namespace App\Domain\Notifier;

interface NotifierInterface {
    /**
     * This could probably return a response object of some kind, but...
     * @return void
     */
    public function notifyObservers() : void;
}