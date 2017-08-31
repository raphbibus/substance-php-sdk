<?php

namespace Substance;

use Substance\SubstanceConstants;
use Substance\Models\ContentConnection;
use Substance\Models\Beacon;
use Substance\Traits\GetsHttpClient;
use Substance\Exceptions\ContentConnectionFailedException;
use Substance\Exceptions\DiscontentConnectionFailedException;

class SubstanceConnector {

    use GetsHttpClient;

    public function __construct() {}

    /**
    * @param    ContentConnection $contentConnection    A contentConnection object
    * @param    string            $token                JWT bearer token in the form of "Bearer {token}"
    * @return   Beacon                                  The updated beacon
    */
    public function connect(ContentConnection $contentConnection, string $token) {

        $client = $this->getClient('application/json',$token);

        try {
            $response = $client->request('POST', SubstanceConstants::getConnectBeaconUrl(),[
                'json' => $contentConnection->toPayload()
            ]);
        } catch(\Exception $e) {
            throw new ContentConnectionFailedException($e->getMessage(),$e->getCode());
        }

        if($response->getStatusCode() == 200) {

            $body = $response->getBody();
            $data = json_decode($body->getContents());
            $beacon = new Beacon($data->data);
            return $beacon;

        }

        return null;

    }

    public function disconnect(Beacon $beacon, string $token) {

        $client = $this->getClient('application/json',$token);

        try {
            $response = $client->request('POST', SubstanceConstants::getDisonnectBeaconUrl(),[
                'json' => $beacon->toPayload()
            ]);
        } catch(\Exception $e) {
            throw new DiscontentConnectionFailedException($e->getMessage(),$e->getCode());
        }

        if($response->getStatusCode() == 200) {

            $body = $response->getBody();
            $data = json_decode($body->getContents());
            $beacon = new Beacon($data->data);
            return $beacon;

        }

        return null;

    }

}
