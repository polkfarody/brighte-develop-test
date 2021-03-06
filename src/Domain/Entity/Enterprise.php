<?php

namespace App\Domain\Entity;

use App\Domain\Collection\ContactArrayCollection;
use App\Domain\Validate\ValidatableInterface;
use App\Domain\ValueObject\Contact;
use App\Domain\Util\ArrayKeyValues;

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
    public function getName(): ?string {
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
    public function getType(): ?string {
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
    public function getAbn(): ?string {
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
    public function getDirectors(): ?ContactArrayCollection {
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

    public function setValid(bool $valid) : ValidatableInterface {
        $this->valid = $valid;
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
            ArrayKeyValues::validate(['name' => 'string', 'address' => 'string'], $director);

            $contacts[] = new Contact($director['name'], $director['address']);
        }

        return new ContactArrayCollection($contacts);
    }

    public function unload() : array {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'abn'  => $this->abn,
            'directors' => $this->unloadDirectors(),
            'valid' => $this->isValid() ? 1 : 0
        ];
    }

    /**
     * @param array $array
     * @throws InvalidArgumentException
     */
    public function load(array $array) : Enterprise {
        $reqKeys = [
            'name' => 'string', 
            'type' => 'string', 
            'abn' => 'string',
            'directors' => 'array'
        ];

        ArrayKeyValues::validate($reqKeys, $array, function($reqKey, $value) {
            $this->{$reqKey} = $value;
        });

        // Special case for directors and valid
        $this->directors = $this->loadDirectors($array['directors']);    
        $this->valid = ($array['valid'] ?? false) != false;

        return $this;      
    }
}
