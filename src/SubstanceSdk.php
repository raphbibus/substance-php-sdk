<?php

namespace Substance;

use Substance\SubstanceConstants;
use Substance\AvailableBeacons;
use Substance\SubstanceConnector;
use Substance\Models\Beacon;
use Substance\Models\ContentConnection;
use Substance\Auth\AppAuthentication;

class SubstanceSdk {

    private $appKey;
    private $appSecret;
    private $appAuthentication;
    private $availableBeacons;

    public function __construct($appKey, $appSecret) {

        $this->appKey = $appKey;
        $this->appSecret = $appSecret;

    }

    public function auth() {
        $this->appAuthentication = new AppAuthentication($this->appKey,$this->appSecret);
    }

    public function getBeacons() {

        if($this->availableBeacons == null) {
            $this->availableBeacons = new AvailableBeacons();
        }
        return $this->availableBeacons->get($this->appAuthentication->getToken());

    }

    public function connectContent(Beacon $beacon,string $url,string $title,string $description) {

        $contentConnection = new ContentConnection($beacon,$url,$title,$description);
        $substanceConnector = new SubstanceConnector();
        return $substanceConnector->connect($contentConnection,$this->appAuthentication->getToken());

    }

    public function disconnectContent(Beacon $beacon) {

        $substanceConnector = new SubstanceConnector();
        return $substanceConnector->disconnect($beacon,$this->appAuthentication->getToken());

    }

}
