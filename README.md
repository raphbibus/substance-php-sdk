# substance-php-sdk
PHP SDK to integrate Substance in CMS systems

## Example

```php

<?php

require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

use Substance\SubstanceSdk;

$substance = new SubstanceSdk("8901544805321d10cbe97e602a88aa8ef5e91970","a5102dbef6e6dc0597ba1e5657e9e5cec1e66898");

$substance->auth();

$beacons = $substance->getBeacons();

$beacon = $beacons->random();
echo $beacon->getName()."\n";
echo $beacon->getAlias()."\n";

$updatedBeacon = $substance->connectContent($beacon,"https://www.rakete7.com","Rakete 7 Website","Hab ich mit dem SDK erstellt!");

echo "connected beacon\n";

echo "sleepting for 15 seconds\n";
sleep(15);

$updatedBeacon = $substance->disconnectContent($updatedBeacon);

echo "disconnected beacon\n";
