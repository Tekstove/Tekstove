<?php

namespace Tekstove\TekstoveBundle\Model\Exception;

/**
 * Error could be shown to user
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
interface HumanReadableInterface
{

    public function getField();
}
