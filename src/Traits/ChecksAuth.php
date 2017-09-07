<?php

namespace Substance\Traits;

use Substance\Exceptions\NotAuthenticatedException;

trait ChecksAuth {

    private function checkAuth() {
        if($this->appAuthentication == null || !$this->appAuthentication->isAuthenticated()) throw new NotAuthenticatedException();
    }

}
