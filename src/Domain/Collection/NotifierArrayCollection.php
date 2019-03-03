<?php

namespace App\Domain\Collection;

use App\Domain\Notifier\NotifierInterface;
use InvalidArgumentException;

class NotifierArrayCollection extends ArrayCollection {
    /**
     * NotifierArrayCollection constructor.
     * @param NotifierInterface[] | array $notifiers
     */
    public function __construct(array $notifiers = []) {
        foreach ($notifiers as $notifier) {
            if (!$notifier instanceof NotifierInterface) {
                throw new InvalidArgumentException('Notifier must be an instance of NotifierInterface');
            }
        }

        parent::__construct($notifiers);
    }
}