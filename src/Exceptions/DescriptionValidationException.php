<?php

namespace Substance\Exceptions;

use Substance\Exceptions\ValidationException;

class DescriptionValidationException extends ValidationException {

    protected $message = "Given string must be between 1 and 255 characters long.";

}
