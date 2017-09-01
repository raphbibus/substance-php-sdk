<?php

namespace Substance\Models;

use Substance\Models\Beacon;
use Substance\Models\Content;

class ContentConnection {

    /**
     * Connectable beacon
     * @var Substance\Models\Beacon
     */
    private $beacon;

    /**
     * Content that gets connected to the beacon
     * @var Substance\Models\Content
     */
    private $content;

    /**
     * Create a new ContentConnection instance
     * @param   Substance\Models\Beacon     $beacon      Connectable beacon
     * @param   Substance\Models\Content    $content     Content that gets connected to the beacon
     */
    public function __construct(Beacon $beacon,Content $content) {

        $this->setBeacon($beacon);
        $this->setContent($content);

    }

    /**
     * Transform object to required payload for HTTP requests against Substance backend
     * @return  array   jsonable payload
     */
    public function toPayload() {
        return [
            'beacon_id' => $this->beacon->getId(),
            'url' => $this->content->getUrl(),
            'title' => $this->content->getTitle(),
            'description' => $this->content->getDescription()
        ];
    }

    public function getBeacon() {
        return $this->beacon;
    }

    public function getContent() {
        return $this->content;
    }

    public function setBeacon(Beacon $beacon) {
        $this->beacon = $beacon;
    }

    public function setContent(Content $content) {
        $this->content = $content;
    }

}
