<?php

namespace Substance\Exceptions;

class DisassociateConnectionFailedException extends \Exception {

    protected $code = 400;
    protected $message = "Could not disconnect beacon from content.";

}
