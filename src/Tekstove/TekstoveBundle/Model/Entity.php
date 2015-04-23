<?php

namespace Tekstove\TekstoveBundle\Model;

/**
 * Description of Entity
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Entity
{

    public function __set($p, $s) {
        throw new \Exception('__set is forbidden');
    }

    public function __get($p) {
        throw new \Exception('__get is forbidden');
    }

}
