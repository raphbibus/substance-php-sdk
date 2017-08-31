<?php

namespace Substance\Exceptions;

class ContentConnectionFailedException extends \Exception {

    protected $code = 400;
    protected $message = "Could not connect beacon with content.";

}
