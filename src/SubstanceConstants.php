<?php

namespace Substance;

class SubstanceConstants {

    // const SUBSTANCE_API_URL = "https://substance.rakete7.com/api/";

    const SUBSTANCE_API_URL = "http://substance.app/api/";

    const AUTH_NAMESPACE = "auth/login/apps";

    const AVAILABLE_BEACONS_NAMESPACE = "sdk/beacons";

    const CONNECT_BEACON_NAMESPACE = "sdk/beacons/connect";

    const DISCONNECT_BEACON_NAMESPACE = "sdk/beacons/disconnect";

    public static function getSubstanceApiUrl() {
        return self::SUBSTANCE_API_URL;
    }

    public static function getAuthUrl() {
        return self::AUTH_NAMESPACE;
    }

    public static function getAvailableBeaconsUrl() {
        return self::AVAILABLE_BEACONS_NAMESPACE;
    }

    public static function getConnectBeaconUrl() {
        return self::CONNECT_BEACON_NAMESPACE;
    }

    public static function getDisonnectBeaconUrl() {
        return self::DISCONNECT_BEACON_NAMESPACE;
    }

}
