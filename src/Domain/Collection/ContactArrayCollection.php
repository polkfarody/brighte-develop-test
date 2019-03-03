<?php

namespace App\Domain\Collection;

use App\Domain\ValueObject\Contact;
use InvalidArgumentException;

class ContactArrayCollection extends ArrayCollection {
    /**
     * ContactArrayCollection constructor.
     * @param Contact[] | array $contacts
     */
    public function __construct(array $contacts = []) {
        foreach ($contacts as $contact) {
            if (!$contact instanceof Contact) {
                throw new InvalidArgumentException('Contact must be an instance of Contact');
            }
        }

        parent::__construct($contacts);
    }
}