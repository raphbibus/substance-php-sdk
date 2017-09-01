<?php

namespace Substance\Traits;

trait DecodesResponseBody {

    /**
     * Decodes the Guzzle body
     * @param  GuzzleHttp\Psr7\Response     $response   Guzzle Response
     * @return object                                   JSON decoded response body
     */
    protected function decodeBody($response) {

        $body = $response->getBody();
        return json_decode($body->getContents());

    }

}
