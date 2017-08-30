<?php

namespace Substance;

use Substance\SubstanceConstants;
use Substance\AvailableBeacons;
use Substance\Auth\AppAuthentication;

class SubstanceSdk {

    private $appKey;
    private $appSecret;
    private $appAuthentication;

    public function __construct($appKey, $appSecret) {

        $this->appKey = $appKey;
        $this->appSecret = $appSecret;

    }

    public function auth() {

        $this->appAuthentication = new AppAuthentication($this->appKey,$this->appSecret);

        $token = $this->appAuthentication->getToken();
        //
        // return $token;

    }

    public function getBeacons() {

        $availableBeacons = new AvailableBeacons();
        return $availableBeacons->get($this->appAuthentication->getToken());

    }

}
