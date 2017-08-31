<?php

namespace Substance\Models;

class Beacon {

    private $id;
    private $name;
    private $alias;
    private $connected;

    public function __construct($payloadItem) {

        $this->id = $payloadItem->id;
        $this->name = $payloadItem->name;
        $this->alias = $payloadItem->alias;
        $this->connected = $payloadItem->connected;

    }

    public function toPayload() {
        return [
            'beacon_id' => $this->id
        ];
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAlias() {
        return $this->alias;
    }

    public function getConnected() {
        return $this->connected;
    }

    public function setConnected(boolean $connected) {
        $this->connected = $connected;
    }

}
