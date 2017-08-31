<?php

namespace Substance\Exceptions;

class UrlValidationException extends ValidationException {

    protected $message = "Given string must be a valid URL.";

}
