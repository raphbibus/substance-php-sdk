<?php

namespace Substance\Models;

use Substance\Models\Beacon;
use Substance\Exceptions\UrlValidationException;
use Substance\Exceptions\TitleValidationException;
use Substance\Exceptions\DescriptionValidationException;

class ContentConnection {

    private $beacon;
    private $url;
    private $title;
    private $description;

    public function __construct(Beacon $beacon,string $url,string $title,string $description) {

        $this->setBeacon($beacon);
        $this->setUrl($url);
        $this->setTitle($title);
        $this->setDescription($description);

    }

    public function toPayload() {
        return [
            'beacon_id' => $this->beacon->getId(),
            'url' => $this->url,
            'title' => $this->title,
            'description' => $this->description
        ];
    }

    public function getBeacon() {
        return $this->beacon;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setBeacon(Beacon $beacon) {
        $this->beacon = $beacon;
    }

    public function setUrl(string $url) {
        if(filter_var($url, FILTER_VALIDATE_URL)) {
            $this->url = $url;
        } else {
            throw new UrlValidationException();
        }
    }

    public function setTitle(string $title) {
        if(strlen($title)>=1 && strlen($title)<=40) {
            $this->title = $title;
        } else {
            throw new TitleValidationException();
        }
    }

    public function setDescription(string $description) {
        if(strlen($description)>=1 && strlen($description)<=255) {
            $this->description = $description;
        } else {
            throw new DescriptionValidationException();
        }
    }

}
