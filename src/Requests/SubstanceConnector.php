<?php

namespace Substance\Requests;

use Substance\SubstanceConstants;
use Substance\Models\ContentConnection;
use Substance\Models\Beacon;
use Substance\Requests\SubstanceRequest;

class SubstanceConnector extends SubstanceRequest {

    /**
     * Connect a URL and a beacon in Substance
     * @param    Substance\Models\ContentConnection $contentConnection    A contentConnection object
     * @param    string                             $token                JWT bearer token in the form of "Bearer {token}"
     * @return   Substance\Models\Beacon                                  The updated beacon
     */
    public function connect(ContentConnection $contentConnection, string $token) {

        $client = $this->getClient('application/json',$token);
        $response = $this->getEndpointResponse($client,'POST',SubstanceConstants::getConnectBeaconUrl(),'Substance\Exceptions\ContentConnectionFailedException',$contentConnection->toPayload());
        $data = $this->decodeBody($response);

        $beacon = new Beacon($data->data);
        return $beacon;

    }

    /**
     * Disconnect a beacon from any content in Substance
     * @param    Substance\Models\Beacon    $beacon      Beacon to disconnect
     * @param    string                     $token       JWT bearer token in the form of "Bearer {token}"
     * @return   Substance\Models\Beacon                 The updated beacon
     */
    public function disconnect(Beacon $beacon, string $token) {

        $client = $this->getClient('application/json',$token);
        $response = $this->getEndpointResponse($client,'POST',SubstanceConstants::getDisonnectBeaconUrl(),'Substance\Exceptions\DiscontentConnectionFailedException',$beacon->toPayload());
        $data = $this->decodeBody($response);

        $beacon = new Beacon($data->data);
        return $beacon;

    }

}
