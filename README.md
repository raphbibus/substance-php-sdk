# substance-php-sdk
PHP SDK to integrate Substance in CMS systems

## Example

```php

<?php

require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

use Substance\SubstanceSdk;
use Substance\Models\Content;
use Substance\Models\ContentConnection;

$substance = new SubstanceSdk("8991544805321d10cbe97e602a88aa8ef5e91xxx","a5002dbef6e6dc0597ba1e5657e9e5cec1e66xxx");

$substance->auth();

$beacons = $substance->getBeacons();

$beacon = $beacons->random();
echo $beacon->getName()."\n";
echo $beacon->getAlias()."\n";

$content = new Content("https://www.rakete7.com","Rakete 7 Website","Hab ich mit dem SDK erstellt!");

$contentConnection = new ContentConnection($beacon,$content);

$updatedBeacon = $substance->connectContent($contentConnection);

echo "connected beacon\n";

$updatedBeacon = $substance->disconnectContent($updatedBeacon);

echo "disconnected beacon\n";
