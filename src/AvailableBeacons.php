<?php

namespace Substance;

use Substance\SubstanceConstants;
use Substance\Models\Beacon;
use Substance\Traits\GetsHttpClient;

class AvailableBeacons {

    use GetsHttpClient;

    /**
     * Array of available beacons
     * @var array $beacons
     */
    private $beacons = [];

    /**
     * Collection of available beacons
     * @var Collection $beaconCollection
     */
    private $beaconCollection;

    /**
     * Get available beacons from Substance backend
     * @param    string      $token      JWT bearer token in the form of "Bearer {token}"
     * @return   Collection              collection object of beacons
     */
    public function get(string $token) {

        $client = $this->getClient(null,$token);

        try {
            $response = $client->request('GET', SubstanceConstants::getAvailableBeaconsUrl());
        } catch(\Exception $e) {
            throw new AvailableBeaconsFailedException($e->getMessage(),$e->getCode());
        }

        if($response->getStatusCode() == 200) {

            $body = $response->getBody();

            $data = json_decode($body->getContents());

            foreach($data->data as $payloadItem) {
                $this->beacons[] = new Beacon($payloadItem);
            }

        }

        $this->beaconCollection = collect($this->beacons);
        return $this->beaconCollection;

    }

}
