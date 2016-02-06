<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Client;

/**
 *
 * @author po_taka
 */
class Response
{
    private $body;
    
    public function __construct($body)
    {
        $this->body = $body;
    }
    
    public function getBody()
    {
        return $this->body;
    }
}
