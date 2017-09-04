<?php

use PHPUnit\Framework\TestCase;

use Substance\SubstanceSdk;
use Substance\Exceptions\AppAuthenticationFailedException;
use Substance\Exceptions\AppKeyValidationException;
use Substance\Exceptions\AppSecretValidationException;

/**
 * @covers SubstanceSdk
 */
final class SubstanceSdkTest extends TestCase {

    public function testCanBeCreatedWithCredentials() {

        $this->assertInstanceOf(
            SubstanceSdk::class,
            new SubstanceSdk('356a192b7913b04c54574d18c28d46e6395428ab','da4b9237bacccdf19c0760cab7aec4a8359010b0')
        );

    }

    // public function testCanAuthenticateWithValidCredentials() {
    //
    //     $substance = new SubstanceSdk('8991544805321d10cbe97e602a88aa8ef5e91969','a5002dbef6e6dc0597ba1e5657e9e5cec1e66887');
    //     $substance->auth();
    // }

    public function testCannotAuthenticateWithInvalidCredentials() {

        $substance = new SubstanceSdk('356a192b7913b04c54574d18c28d46e6395428ab','da4b9237bacccdf19c0760cab7aec4a8359010b0');
        $this->setExpectedException(AppAuthenticationFailedException::class);
        $substance->auth();

    }

    public function testCannotAuthenticateWithTooShortAppKey() {

        $substance = new SubstanceSdk('356a192b7913b04c54574d18c28d46e6395428a','da4b9237bacccdf19c0760cab7aec4a8359010b0');
        $this->setExpectedException(AppKeyValidationException::class);
        $substance->auth();

    }

    public function testCannotAuthenticateWithTooShortAppSecret() {

        $substance = new SubstanceSdk('356a192b7913b04c54574d18c28d46e6395428ab','da4b9237bacccdf19c0760cab7aec4a8359010b');
        $this->setExpectedException(AppSecretValidationException::class);
        $substance->auth();

    }

    public function testCannotAuthenticateWithTooLongAppKey() {

        $substance = new SubstanceSdk('356a192b7913b04c54574d18c28d46e6395428aadcf','da4b9237bacccdf19c0760cab7aec4a8359010b0');
        $this->setExpectedException(AppKeyValidationException::class);
        $substance->auth();

    }

    public function testCannotAuthenticateWithTooLongAppSecret() {

        $substance = new SubstanceSdk('356a192b7913b04c54574d18c28d46e6395428ab','da4b9237bacccdf19c0760cab7aec4a8359010badfed');
        $this->setExpectedException(AppSecretValidationException::class);
        $substance->auth();

    }

}
