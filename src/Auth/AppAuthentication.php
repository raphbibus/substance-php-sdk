<?php

namespace Substance\Auth;

use GuzzleHttp\Client;
use Substance\SubstanceConstants;
use Substance\Exceptions\AppKeyValidationException;
use Substance\Exceptions\AppSecretValidationException;
use Substance\Exceptions\AppAuthenticationFailedException;
use Substance\Traits\GetsHttpClient;

class AppAuthentication {

    use GetsHttpClient;

    /**
     * JWT token
     * @var string $token
     */
    private $token;

    /**
     * Substance app key
     * @var string $appKey
     */
    private $appKey;

    /**
     * Substance app secret
     * @var string $appSecret
     */
    private $appSecret;

    /**
     * Authentication status
     * @var boolean $authenticated
     */
    private $authenticated = false;

    /**
     * Create new AppAuthentication instance
     * @param string $appKey    Substance app key
     * @param string $appSecret Substance app secret
     */
    public function __construct(string $appKey, string $appSecret) {

        $this->setAppKey($appKey);
        $this->setAppSecret($appSecret);

    }

    /**
     * Get the JWT token for authentication
     * @param  boolean $withBearer  Prepends the "Bearer " string for HTTP auth header
     * @return string               JWT token with or without Bearer prefix
     */
    public function getToken($withBearer = true) {

        if($this->token == null) {
            $this->login();
        }

        return $withBearer ? "Bearer {$this->token}" : $this->token;
    }

    /**
     * Get a new JWT token for authentication
     * @return void
     */
    public function login() {

        $client = $this->getClient('application/json');

        $payload = [
            'key' => $this->appKey,
            'secret' => $this->appSecret
        ];

        try {
            $response = $client->request('POST', SubstanceConstants::getAuthUrl(), [
                'json' => $payload
            ]);
        } catch(\Exception $e) {
            throw new AppAuthenticationFailedException($e->getMessage(),$e->getCode());
        }

        $data = $this->decodeBody($response);
        $this->token = $data->data->token;
        $this->authenticated = true;

    }

    /**
     * Get authentication status
     * @return boolean authentication status
     */
    public function isAuthenticated() {
        return $this->authenticated;
    }

    /**
     * Decodes the Guzzle body
     * @param  Response $response   Guzzle Response
     * @return object               JSON decoded response body
     */
    private function decodeBody($response) {

        $body = $response->getBody();
        return json_decode($body->getContents());

    }

    /**
     * Set Substance app key
     * @param string $appKey Susbtance app key
     * @return void
     */
    private function setAppKey(string $appKey) {

        if(strlen($appKey) == 40) {
            $this->appKey = $appKey;
        } else {
            throw new AppKeyValidationException();
        }

    }

    /**
     * Set Substance app secret
     * @param string $appSecret Susbtance app secret
     * @return void
     */
    private function setAppSecret(string $appSecret) {

        if(strlen($appSecret) == 40) {
            $this->appSecret = $appSecret;
        } else {
            throw new AppSecretValidationException();
        }

    }

}
