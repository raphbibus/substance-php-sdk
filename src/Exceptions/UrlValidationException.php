<?php

namespace Substance\Exceptions;

use Substance\Exceptions\ValidationException;

class UrlValidationException extends ValidationException {

    protected $message = "Given string must be a valid URL.";

}
