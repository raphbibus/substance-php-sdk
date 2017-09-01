<?php

namespace Substance\Exceptions;

use Substance\Exceptions\ValidationException;

class AppSecretValidationException extends ValidationException {

    protected $message = "The app secret must be 40 characters long.";

}
