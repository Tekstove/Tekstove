<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception;

/**
 * Description of RequestException
 *
 * @author po_taka
 */
class RequestException extends \Exception
{
    private $body;
    
    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }
}
