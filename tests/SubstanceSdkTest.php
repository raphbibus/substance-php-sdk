<?php

use PHPUnit\Framework\TestCase;

use Substance\SubstanceSdk;
use Substance\Models\Beacon;
use Substance\Models\Content;
use Substance\Models\ContentAssociation;
use Substance\Exceptions\AppAuthenticationFailedException;
use Substance\Exceptions\AppKeyValidationException;
use Substance\Exceptions\AppSecretValidationException;
use Substance\Exceptions\NotAuthenticatedException;
use Substance\Exceptions\UrlValidationException;
use Substance\Exceptions\TitleValidationException;
use Substance\Exceptions\DescriptionValidationException;

/**
 * @covers SubstanceSdk
 */
final class SubstanceSdkTest extends TestCase {

    private $faker;
    private $validAppKey = '75ad228a6df77254347ebe7d0dbd8e205d9ce101';
    private $validAppSecret = '8e4e4d5b8a8f1b68b68470995b084f61859df394';

    public function __construct() {
        $this->faker = Faker\Factory::create();
    }

    public function testCanBeCreatedWithCredentials() {

        $this->assertInstanceOf(
            SubstanceSdk::class,
            new SubstanceSdk($this->validAppKey,$this->validAppSecret)
        );

    }

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

    public function testCanGetBeaconsWhenAuthenticated() {

        $substance = new SubstanceSdk($this->validAppKey,$this->validAppSecret);
        $substance->auth();
        $beacons = $substance->getBeacons();
        $this->assertInstanceOf(
            Illuminate\Support\Collection::class,
            $beacons
        );
    }

    public function testCanCreateContentWithValidParams() {

        $content = new Content($this->faker->url,$this->faker->text(mt_rand(5,40)),$this->faker->text(mt_rand(5,255)));
        $this->assertInstanceOf(
            Content::class,
            $content
        );

    }

    public function testCannotCreateContentWithInvalidUrl() {


        $this->setExpectedException(UrlValidationException::class);
        $content = new Content($this->faker->text(mt_rand(5,40)),$this->faker->text(mt_rand(5,40)),$this->faker->text(mt_rand(5,255)));

    }

    public function testCannotCreateContentWithInvalidLongTitle() {

        $title = "Voon8zRCT8G8RhYu4scU6r0qDsYU2geprQ3tu8tVp";

        $this->setExpectedException(TitleValidationException::class);
        $content = new Content($this->faker->url,$title,$this->faker->text(mt_rand(5,255)));

    }

    public function testCannotCreateContentWithInvalidShortTitle() {

        $title = "";

        $this->setExpectedException(TitleValidationException::class);
        $content = new Content($this->faker->url,$title,$this->faker->text(mt_rand(5,255)));

    }

    public function testCannotCreateContentWithInvalidLongDescription() {

        $desc = "9cIWsbd1OpfJZntOBfOmK1AKe9mrun5I1zT55qYcDYYXmNpyrYBEHxF95r96on79dmSxcOQUCnYhmYtffM617Q3kpvGXEvHiiv9nHSuaH5APZdUKm18JSrB2aCdWkHBxRoqYOrQeuBrvJOQnfnn4JGuGVer6lYxzW53mJY6zMyaz6zHulNqf5E9bg6dI3QZgsCu4R2saeHRGQJBzkqx5OwtJBxw3igRfzLp8fWD7NoGHM5936Lc6twI5d1C6X8Cp";

        $this->setExpectedException(DescriptionValidationException::class);
        $content = new Content($this->faker->url,$this->faker->text(mt_rand(5,40)),$desc);

    }

    public function testCannotCreateContentWithInvalidShortDescription() {

        $desc = "";

        $this->setExpectedException(DescriptionValidationException::class);
        $content = new Content($this->faker->url,$this->faker->text(mt_rand(5,40)),$desc);

    }

    public function testCanCreateContentAssociationWithValidParams() {

        $substance = new SubstanceSdk($this->validAppKey,$this->validAppSecret);
        $substance->auth();
        $beacons = $substance->getBeacons();
        $beacon = $beacons->random();
        $content = new Content($this->faker->url,$this->faker->text(mt_rand(5,40)),$this->faker->text(mt_rand(5,255)));
        $contentAssociation = new ContentAssociation($beacon,$content);
        $this->assertInstanceOf(
            ContentAssociation::class,
            $contentAssociation
        );

    }

    public function testCannotCreateContentAssociationWithInvalidBeacon() {

        $substance = new SubstanceSdk($this->validAppKey,$this->validAppSecret);
        $substance->auth();
        $content = new Content($this->faker->url,$this->faker->text(mt_rand(5,40)),$this->faker->text(mt_rand(5,255)));
        $this->setExpectedException(\TypeError::class);
        $contentAssociation = new ContentAssociation(new \StdClass,$content);

    }

    public function testCannotCreateContentAssociationWithInvalidContent() {

        $substance = new SubstanceSdk($this->validAppKey,$this->validAppSecret);
        $substance->auth();
        $beacons = $substance->getBeacons();
        $beacon = $beacons->random();
        $this->setExpectedException(\TypeError::class);
        $contentAssociation = new ContentAssociation($beacon,new \StdClass);

    }

    public function testCannotGetBeaconsWhenNotAuthenticated() {

        $substance = new SubstanceSdk($this->validAppKey,$this->validAppSecret);
        $this->setExpectedException(NotAuthenticatedException::class);
        $beacons = $substance->getBeacons();

    }

    public function testCanAssociateContent() {

        $substance = new SubstanceSdk($this->validAppKey,$this->validAppSecret);
        $substance->auth();
        $beacons = $substance->getBeacons();
        $beacon = $beacons->random();
        $content = new Content($this->faker->url,$this->faker->text(mt_rand(5,40)),$this->faker->text(mt_rand(5,255)));
        $contentAssociation = new ContentAssociation($beacon,$content);
        $updatedBeacon = $substance->associateContent($contentAssociation);
        $this->assertInstanceOf(
            Beacon::class,
            $updatedBeacon
        );

    }

    public function testCanDisassociateContent() {

        $substance = new SubstanceSdk($this->validAppKey,$this->validAppSecret);
        $substance->auth();
        $beacons = $substance->getBeacons();
        $beacon = $beacons->random();
        $updatedBeacon = $substance->disassociateContent($beacon);
        $this->assertInstanceOf(
            Beacon::class,
            $updatedBeacon
        );

    }

}
