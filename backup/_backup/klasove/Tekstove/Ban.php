<?php

namespace Tekstove;

/**
 * Description of Ban
 *
 * @author potaka
 */
class Ban {

    public $comment;
    private $id;
    private $date;
    private $ipInt;

    function __construct($data = array()) {
        $data = array_merge(array(
            'comment' => null,
            'id' => null,
            'date' => null,
            'ip' => null,
                ), $data);


        $this->comment = $data['comment'];
        $this->id = $data['id'];
        $this->date = $data['date'];
        $this->ipInt = $data['ip'];
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setIpInt($ipInt) {
        $this->ipInt = $ipInt;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getDateTime() {
        return $this->date;
    }

}