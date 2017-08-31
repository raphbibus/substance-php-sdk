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

    private $token;

    private $appKey;
    private $appSecret;

    private $authenticated = false;

    public function __construct(string $appKey, string $appSecret) {

        $this->setAppKey($appKey);
        $this->setAppSecret($appSecret);

    }

    public function getToken($withBearer = true) {

        if($this->token == null) {
            $this->login();
        }

        return $withBearer ? "Bearer {$this->token}" : $this->token;
    }

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

    public function isAuthenticated() {
        return $this->authenticated;
    }

    private function decodeBody($response) {

        $body = $response->getBody();
        return json_decode($body->getContents());

    }

    private function setAppKey(string $appKey) {

        if(strlen($appKey) == 40) {
            $this->appKey = $appKey;
        } else {
            throw new AppKeyValidationException();
        }

    }

    private function setAppSecret(string $appSecret) {

        if(strlen($appSecret) == 40) {
            $this->appSecret = $appSecret;
        } else {
            throw new AppSecretValidationException();
        }

    }

}
