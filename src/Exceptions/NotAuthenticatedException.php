<?php

namespace Substance\Exceptions;

class NotAuthenticatedException extends \Exception {

    protected $code = 401;
    protected $message = "Please authenticate first.";

}
