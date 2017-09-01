<?php

namespace Substance\Models;

use Substance\Exceptions\UrlValidationException;
use Substance\Exceptions\TitleValidationException;
use Substance\Exceptions\DescriptionValidationException;

class Content {

    /**
     * Content URL that gets connected to the beacon
     * @var string
     */
    private $url;

    /**
     * Notification title
     * @var string
     */
    private $title;

    /**
     * Notification description
     * @var string
     */
    private $description;

    /**
     * Create a new Content instance
     * @param   string  $url         Content URL that gets connected to the beacon
     * @param   string  $title       Notification title
     * @param   string  $description Notification description
     */
    public function __construct(string $url,string $title,string $description) {

        $this->setUrl($url);
        $this->setTitle($title);
        $this->setDescription($description);

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
