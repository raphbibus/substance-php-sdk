<?php

namespace Substance\Auth;

use GuzzleHttp\Client;
use Substance\SubstanceConstants;
use Substance\Exceptions\AppKeyValidationException;
use Substance\Exceptions\AppSecretValidationException;
use Substance\Exceptions\AppAuthenticationFailedException;

class AppAuthentication {

    private $token;

    private $appKey;
    private $appSecret;

    public function __construct($appKey, $appSecret) {

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

        $client = new Client([
            'base_uri' => SubstanceConstants::getSubstanceApiUrl(),
            'timeout' => 10.0,
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        $payload = [
            'key' => $this->appKey,
            'secret' => $this->appSecret
        ];

        $response = $client->request('POST', SubstanceConstants::getAuthUrl(), [
            'json' => $payload
        ]);
        //TODO: catch guzzle exception GuzzleHttp\Exception\ClientException
        if($response->getStatusCode() != 201) {

            $data = $this->decodeBody($response);
            throw new AppAuthenticationFailedException($data->message,$response->getStatusCode());

        } else {

            $data = $this->decodeBody($response);
            $this->token = $data->data->token;

        }

    }

    private function decodeBody($response) {

        $body = $response->getBody();
        return json_decode($body->getContents());

    }

    private function setAppKey(string $appKey) {

        if(strlen($appKey) != 40) {
            throw new AppKeyValidationException();
        } else {
            $this->appKey = $appKey;
        }

    }

    private function setAppSecret(string $appSecret) {

        if(strlen($appSecret) != 40) {
            throw new AppSecretValidationException();
        } else {
            $this->appSecret = $appSecret;
        }

    }

}
