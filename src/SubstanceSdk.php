<?php

namespace Substance;

use Substance\SubstanceConstants;
use Substance\Requests\AvailableBeacons;
use Substance\Requests\SubstanceAssociator;
use Substance\Models\Beacon;
use Substance\Models\Content;
use Substance\Models\ContentAssociation;
use Substance\Requests\Auth\AppAuthentication;
use Substance\Traits\ChecksAuth;

class SubstanceSdk {

    use ChecksAuth;

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
     * @param   string  $appKey     Substance app key
     * @param   string  $appSecret  Substance app secret
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
     * @return  Collection      Laravel collection of available beacons (https://laravel.com/docs/5.5/collections)
     */
    public function getBeacons() {

        $this->checkAuth();

        if($this->availableBeacons == null) {
            $this->availableBeacons = new AvailableBeacons();
        }

        return $this->availableBeacons->get($this->appAuthentication->getToken());

    }

    /**
     * Connect a beacon with content
     * @param  Substance\Models\ContentConnection   $contentConnection  The content and beacon connection to be created in Substance
     * @return Substance\Models\Beacon                                  The updated (connected) beacon
     */
    public function associateContent(ContentAssociation $contentAssociation) {

        $this->checkAuth();
        $substanceAssociator = new SubstanceAssociator();
        return $substanceAssociator->associate($contentAssociation,$this->appAuthentication->getToken());

    }

    /**
     * Disconnect content from a beacon
     * @param  Substance\Models\Beacon  $beacon Beacon to be disconnected
     * @return Substance\Models\Beacon          The updated (disconnected) beacon
     */
    public function disassociateContent(Beacon $beacon) {

        $this->checkAuth();
        $substanceAssociator = new SubstanceAssociator();
        return $substanceAssociator->disassociate($beacon,$this->appAuthentication->getToken());

    }

}
