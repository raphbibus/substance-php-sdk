<?php

namespace Substance;

use Substance\SubstanceConstants;
use Substance\Requests\AvailableBeacons;
use Substance\Requests\SubstanceConnector;
use Substance\Models\Beacon;
use Substance\Models\ContentConnection;
use Substance\Auth\AppAuthentication;

class SubstanceSdk {

    /**
     * Substance app key - Create a new app in Substance -> Admin -> Apps -> New
     * @var string
     */
    private $appKey;

    /**
     * Substance app secret - Create a new app in Substance -> Admin -> Apps -> New
     * @var string
     */
    private $appSecret;

    /**
     * Substance auth object
     * @var Substance\Auth\AppAuthentication
     */
    private $appAuthentication;

    /**
     * Available beacons for the given app
     * @var Substance\Requests\AvailableBeacons
     */
    private $availableBeacons;

    /**
     * Create a new Substance SDK instance
     * @param string $appKey    Substance app key
     * @param string $appSecret Substance app secret
     */
    public function __construct(string $appKey, string $appSecret) {

        $this->appKey = $appKey;
        $this->appSecret = $appSecret;

    }

    /**
     * Authenticate app against Substance backend
     * @return void
     */
    public function auth() {
        $this->appAuthentication = new AppAuthentication($this->appKey,$this->appSecret);
    }

    /**
     * Get available beacons of authenticated app
     * @return Collection   Laravel collection of available beacons (https://laravel.com/docs/5.5/collections)
     */
    public function getBeacons() {

        if($this->availableBeacons == null) {
            $this->availableBeacons = new AvailableBeacons();
        }
        return $this->availableBeacons->get($this->appAuthentication->getToken());

    }

    /**
     * Connect a beacon with content
     * @param  Beacon $beacon      Beacon to be connected to given URL
     * @param  string $url         The URL that gets connected to the beacon, HTTPS preferred
     * @param  string $title       The notification title for the Physical Web
     * @param  string $description The notification description for the Phyiscal Web
     * @return Beacon              The updated (connected) beacon
     */
    public function connectContent(Beacon $beacon,string $url,string $title,string $description) {

        $contentConnection = new ContentConnection($beacon,$url,$title,$description);
        $substanceConnector = new SubstanceConnector();
        return $substanceConnector->connect($contentConnection,$this->appAuthentication->getToken());

    }

    /**
     * Disconnect content from a beacon
     * @param  Beacon $beacon      Beacon to be disconnected
     * @return Beacon              The updated (disconnected) beacon
     */
    public function disconnectContent(Beacon $beacon) {

        $substanceConnector = new SubstanceConnector();
        return $substanceConnector->disconnect($beacon,$this->appAuthentication->getToken());

    }

}
