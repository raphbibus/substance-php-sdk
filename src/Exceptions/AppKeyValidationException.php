<?php

namespace Substance\Exceptions;

use Substance\Exceptions\ValidationException;

class AppKeyValidationException extends ValidationException {

    protected $message = "The app key must be 40 characters long.";

}
