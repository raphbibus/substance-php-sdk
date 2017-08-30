<?php

namespace Substance\Exceptions;

class AppKeyValidationException extends ValidationException {

    protected $message = "The app key must be 40 characters long.";

}
