<?php

namespace Tekstove\TekstoveBundle\Model\Gateway;

use GuzzleHttp\Client;

/**
 * Description of Abstractgateway
 *
 * @author potaka
 */
class Abstractgateway implements GatewayInterface
{
    private $client;
    
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    public function getClient()
    {
        return $this->client;
    }
}
