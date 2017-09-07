<?php

namespace Substance\Exceptions;

use Substance\Exceptions\ValidationException;

class TitleValidationException extends ValidationException {

    protected $message = "Given string must be between 1 and 40 characters long.";

}
