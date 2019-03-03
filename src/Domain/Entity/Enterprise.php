<?php

namespace App\Domain\Entity;

use App\Domain\Collection\ContactArrayCollection;
use App\Domain\Validate\ValidatableInterface;
use App\Domain\ValueObject\Contact;

class Enterprise implements ValidatableInterface {
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $abn;

    /**
     * @var ContactArrayCollection
     */
    protected $directors;

    /**
     * @var bool
     */
    protected $valid = false;

    public function __construct(string $name = null, string $type = null, string $abn = null, ContactArrayCollection $directors = null) {
        $this->name = $name;
        $this->type = $type;
        $this->abn = $abn;
        $this->directors = $directors;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Enterprise
     */
    public function setName(string $name): Enterprise {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Enterprise
     */
    public function setType(string $type): Enterprise {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getAbn(): string {
        return $this->abn;
    }

    /**
     * @param string $abn
     * @return Enterprise
     */
    public function setAbn(string $abn): Enterprise {
        $this->abn = $abn;
        return $this;
    }

    /**
     * @return ContactArrayCollection
     */
    public function getDirectors(): ContactArrayCollection {
        return $this->directors;
    }

    /**
     * @param ContactArrayCollection $directors
     * @return Enterprise
     */
    public function setDirectors(ContactArrayCollection $directors): Enterprise {
        $this->directors = $directors;
        return $this;
    }

    public function isValid() : bool {
        return $this->valid;
    }

    public function setValid() : ValidatableInterface {
        $this->valid = true;
        return $this;
    }

    public function setInvalid() : ValidatableInterface {
        $this->valid = false;
        return $this;
    }

    public function unloadDirectors() : array {
        $directors = [];
        foreach ($this->directors->getAll() as $contact) {
            $directors[] = [
                'name' => $contact->getName(),
                'address' => $contact->getAddress()
            ];
        }

        return $directors;
    }

    public function loadDirectors(array $directors = []) : ContactArrayCollection {
        $contacts = [];

        foreach ($directors as $director) {
            $contacts[] = new Contact($director['name'], $director['address']);
        }

        return new ContactArrayCollection($contacts);
    }

    public function unload() : array {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'abn'  => $this->abn,
            'directors' => $this->unloadDirectors()
        ];
    }

    public function load(array $array) : Enterprise {
        return $this->setName($array['name'])
            ->setType($array['type'])
            ->setAbn($array['abn'])
            ->setDirectors($this->loadDirectors($array['directors']));
    }
}
