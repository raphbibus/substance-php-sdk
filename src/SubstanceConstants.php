<?php

namespace Substance;

class SubstanceConstants {

    const SUBSTANCE_API_URL = "https://substance.rakete7.com/api/";

    const AUTH_NAMESPACE = "auth/login/apps";

    public static function getSubstanceApiUrl() {
        return self::SUBSTANCE_API_URL;
    }

    public static function getAuthUrl() {
        return self::AUTH_NAMESPACE;
    }

}
