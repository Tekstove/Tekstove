<?php

namespace Tekstove\TekstoveBundle\Model\Exception;

use Tekstove\TekstoveBundle\Model\Exception;

/**
 * Description of Validation
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ValidationException extends Exception implements HumanReadableInterface
{
    protected $field = null;

    public function setField($value) {
        $this->field = $value;
    }

    public function getField() {
        return $this->field;
    }
}
