<?php

use PHPUnit\Framework\TestCase;

use Substance\SubstanceSdk;

/**
 * @covers SubstanceSdk
 */
final class SubstanceSdkTest extends TestCase {

    public function testCanBeCreatedWithValidCredentials() {

        $this->assertInstanceOf(
            SubstanceSdk::class,
            new SubstanceSdk('356a192b7913b04c54574d18c28d46e6395428ab','da4b9237bacccdf19c0760cab7aec4a8359010b0')
        );

    }

}
