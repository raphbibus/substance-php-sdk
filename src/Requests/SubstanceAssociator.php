<?php

namespace Substance\Requests;

use Substance\SubstanceConstants;
use Substance\Models\ContentAssociation;
use Substance\Models\Beacon;
use Substance\Requests\SubstanceRequest;

class SubstanceAssociator extends SubstanceRequest {

    /**
     * Associate a URL and a beacon in Substance
     * @param    Substance\Models\ContentAssociation    $contentAssociation  A contentAssociation object
     * @param    string                                 $token              JWT bearer token in the form of "Bearer {token}"
     * @return   Substance\Models\Beacon                                    The updated beacon
     */
    public function associate(ContentAssociation $contentAssociation, string $token) {

        $client = $this->getClient('application/json',$token);
        $response = $this->getEndpointResponse($client,'POST',SubstanceConstants::getConnectBeaconUrl(),'Substance\Exceptions\ContentAssociationFailedException',$contentAssociation->toPayload());
        $data = $this->decodeBody($response);

        $beacon = new Beacon($data->data);
        return $beacon;

    }

    /**
     * Disassociate a beacon from any content in Substance
     * @param    Substance\Models\Beacon    $beacon      Beacon to disconnect
     * @param    string                     $token       JWT bearer token in the form of "Bearer {token}"
     * @return   Substance\Models\Beacon                 The updated beacon
     */
    public function disassociate(Beacon $beacon, string $token) {

        $client = $this->getClient('application/json',$token);
        $response = $this->getEndpointResponse($client,'POST',SubstanceConstants::getDisonnectBeaconUrl(),'Substance\Exceptions\DisassociateConnectionFailedException',$beacon->toPayload());
        $data = $this->decodeBody($response);

        $beacon = new Beacon($data->data);
        return $beacon;

    }

}
