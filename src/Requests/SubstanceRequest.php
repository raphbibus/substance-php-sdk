<?php

namespace Substance\Requests;

use Substance\Traits\GetsHttpClient;
use Substance\Traits\GetsEndpointResponse;
use Substance\Traits\DecodesResponseBody;

class SubstanceRequest {

    use GetsHttpClient, GetsEndpointResponse, DecodesResponseBody;

    public function __construct() {}

}
