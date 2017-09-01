<?php

namespace Substance\Exceptions;

class AvailableBeaconsFailedException extends \Exception {

    protected $code = 400;
    protected $message = "Could not retrieve available beacons.";

}
