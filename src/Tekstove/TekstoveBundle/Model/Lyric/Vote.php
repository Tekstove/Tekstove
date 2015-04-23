<?php

namespace Tekstove\TekstoveBundle\Model\Lyric;

/**
 * Description of Vote
 *
 * @author potaka
 */
class Vote
{

    protected $lyricId;
    protected $userId;

    function __construct($data) {
        $this->lyricId = $data['za'];
        $this->userId = $data['ot'];
    }

    function getLyricId() {
        return $this->lyricId;
    }

    function getUserId() {
        return $this->userId;
    }

}
