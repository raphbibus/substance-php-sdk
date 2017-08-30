<?php

namespace Substance\Exceptions;

class AppAuthenticationFailedException extends \Exception {

    protected $code = 401;
    protected $message = "Could not authenticate the given credentials.";

}
