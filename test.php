<?php

require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

use Substance\SubstanceSdk;

$substance = new SubstanceSdk("8991544805321d10cbe97e602a88aa8ef5e91969","a5002dbef6e6dc0597ba1e5657e9e5cec1e66887");

$substance->auth();

$beacons = $substance->getBeacons();

// var_dump($beacons);

$updatedBeacon = $substance->connectContent($beacons->random(),"https://www.rakete7.com","Rakete 7 Website","Hab ich mit dem SDK erstellt!");

echo "connected beacon";

$updatedBeacon = $substance->disconnectContent($updatedBeacon);

echo "disconnected beacon";
