<?php

namespace Substance\Exceptions;

class ContentAssociationFailedException extends \Exception {

    protected $code = 400;
    protected $message = "Could not associate beacon with content.";

}
