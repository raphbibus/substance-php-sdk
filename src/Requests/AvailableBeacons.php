<?php

namespace Substance\Requests;

use Substance\SubstanceConstants;
use Substance\Models\Beacon;
use Substance\Requests\SubstanceRequest;

class AvailableBeacons extends SubstanceRequest {

    /**
     * Array of available beacons
     * @var array
     */
    private $beacons = [];

    /**
     * Collection of available beacons
     * @var Collection
     */
    private $beaconCollection;

    /**
     * Get available beacons from Substance backend
     * @param  string $token     JWT bearer token in the form of "Bearer {token}"
     * @return Collection        object of beacons
     */
    public function get(string $token) {

        $client = $this->getClient(null,$token);
        $response = $this->getEndpointResponse($client,'GET',SubstanceConstants::getAvailableBeaconsUrl(),'Substance\Exceptions\AvailableBeaconsFailedException');
        $data = $this->decodeBody($response);

        foreach($data->data as $payloadItem) {
            $this->beacons[] = new Beacon($payloadItem);
        }

        $this->beaconCollection = collect($this->beacons);
        return $this->beaconCollection;

    }

}
