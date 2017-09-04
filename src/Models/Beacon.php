<?php

namespace Substance\Models;

class Beacon {

    /**
     * Beacon ID
     * @var string
     */
    private $id;

    /**
     * Beacon name
     * @var string
     */
    private $name;

    /**
     * Beacon alias
     * @var string
     */
    private $alias;

    /**
     * Associated with content status
     * @var boolean
     */
    private $associated;

    /**
     * Create a new Beacon instance
     * @param   object  $payloadItem one item of AvailableBeacons beaconCollection
     */
    public function __construct($payloadItem) {

        $this->id = $payloadItem->id;
        $this->name = $payloadItem->name;
        $this->alias = $payloadItem->alias;
        $this->associated = $payloadItem->associated;

    }

    /**
     * Transform object to required payload for HTTP requests against Substance backend
     * @return  array   jsonable payload
     */
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

    public function getAssociated() {
        return $this->connected;
    }

    public function setAssociated(boolean $associated) {
        $this->associated = $associated;
    }

}
