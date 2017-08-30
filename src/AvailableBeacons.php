<?php

namespace Substance;

use GuzzleHttp\Client;
use Substance\SubstanceConstants;

class AvailableBeacons {

    public function get($token) {

        $client = new Client([
            'base_uri' => SubstanceConstants::getSubstanceApiUrl(),
            'timeout' => 10.0,
            'headers' => [
                'Authorization' => $token
            ]
        ]);

        $response = $client->request('GET', SubstanceConstants::getAvailableBeaconsUrl());

        if($response->getStatusCode() == 200) {

            $body = $response->getBody();

            $data = json_decode($body->getContents());

            return collect($data->data);

        }

        return null;

    }

}
