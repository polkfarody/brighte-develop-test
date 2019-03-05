<?php

namespace App\Domain\Entity;

use App\Domain\Notifier\NotifierObjectInterface;
use App\Domain\Util\ArrayKeyValues;

class Campaign implements NotifierObjectInterface {
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
    protected $ad;

    /**
     * @var bool
     */
    protected $notified = false;

    public function __construct(
        string $name = null,
        string $type = null,
        string $ad = null
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->ad = $ad;
    }

    /**
     * @return string
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Campaign
     */
    public function setName(string $name): Campaign {
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
     * @return Campaign
     */
    public function setType(string $type): Campaign {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getAd(): ?string {
        return $this->ad;
    }

    /**
     * @param string $ad
     * @return Campaign
     */
    public function setAd(string $ad): Campaign {
        $this->ad = $ad;
        return $this;
    }

    /**
     * @param array $array
     * @throws InvalidArgumentException
     */
    public function load(array $array) : void {
        $reqKeys = [
            'name' => 'string', 
            'type' => 'string', 
            'ad' => 'string'
        ];

        ArrayKeyValues::validate($reqKeys, $array, function($reqKey, $value) {
            $this->{$reqKey} = $value;
        });
    }

    public function setNotified(bool $notified): NotifierObjectInterface {
        $this->notified = $notified;
        return $this;
    }

    public function isNotified(): bool {
        return $this->notified;
    }
}