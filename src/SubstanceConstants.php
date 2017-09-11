<?php

namespace Substance;

class SubstanceConstants {

    const SUBSTANCE_API_URL = "https://substance.rakete7.com/api/";

    // const SUBSTANCE_API_URL = "http://substance.app/api/";

    const AUTH_NAMESPACE = "auth/login/apps";

    const AVAILABLE_BEACONS_NAMESPACE = "sdk/beacons";

    const ASSOCIATE_BEACON_NAMESPACE = "sdk/beacons/associate";

    const DISASSOCIATE_BEACON_NAMESPACE = "sdk/beacons/disassociate";

    public static function getSubstanceApiUrl() {
        return self::SUBSTANCE_API_URL;
    }

    public static function getAuthUrl() {
        return self::AUTH_NAMESPACE;
    }

    public static function getAvailableBeaconsUrl() {
        return self::AVAILABLE_BEACONS_NAMESPACE;
    }

    public static function getAssociateBeaconUrl() {
        return self::ASSOCIATE_BEACON_NAMESPACE;
    }

    public static function getDisassociateBeaconUrl() {
        return self::DISASSOCIATE_BEACON_NAMESPACE;
    }

}
