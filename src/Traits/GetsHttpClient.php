<?php

namespace Substance\Traits;

use GuzzleHttp\Client;
use Substance\SubstanceConstants;

trait GetsHttpClient {

    /**
     * Get a HTTP client for Substance backend
     * @param  string $contentType Content-Type for POST requests
     * @param  string $token       JWT token
     * @return GuzzleHttp\Client   Guzzle HTTP Client
     */
    protected function getClient($contentType = null, $token = null) {

        $headers = [];

        if($contentType != null) {
            $headers['Content-Type'] = $contentType;
        }

        if($token != null) {
            $headers['Authorization'] = $token;
        }

        $client = new Client([
            'base_uri' => SubstanceConstants::getSubstanceApiUrl(),
            'timeout' => 10.0,
            'headers' => $headers
        ]);

        return $client;

    }

}
