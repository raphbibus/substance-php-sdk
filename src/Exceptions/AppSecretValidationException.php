<?php

namespace Substance\Exceptions;

class AppSecretValidationException extends ValidationException {

    protected $message = "The app secret must be 40 characters long.";

}
