<?php

namespace Substance\Exceptions;

class UrlValidationException extends ValidationException {

    protected $message = "Given string must be between 1 and 40 characters long.";

}
