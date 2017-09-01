<?php

namespace Substance\Traits;

trait GetsEndpointResponse {

    /**
     * Get the Guzzle HTTP response of a Substance endpoint
     * @param  GuzzleHttp\Client        $client     HTTP clienbt object
     * @param  string                   $method     HTTP method (POST, GET, etc.)
     * @param  string                   $endpoint   Substance endpoint
     * @param  string                   $exception  Substance exception class as string
     * @param  array                    $payload    toPayload array
     * @return GuzzleHttp\Psr7\Response             HTTP response
     */
    protected function getEndpointResponse($client,$method,$endpoint,$exception,$payload = null) {

        try {

            if($payload) {
                $response = $client->request($method, $endpoint, ['json' => $payload]);
            } else {
                $response = $client->request($method, $endpoint);
            }

            return $response;

        } catch(\Exception $e) {
            throw new $exception($e->getMessage(),$e->getCode());
        }

    }

}
