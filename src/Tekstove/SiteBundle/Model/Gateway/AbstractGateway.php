<?php

namespace Tekstove\SiteBundle\Model\Gateway;

use GuzzleHttp\Client;

/**
 * Description of Abstractgateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
abstract class AbstractGateway implements GatewayInterface
{
    private $client;
    
    private $count = 10;
    private $orders = [];
    
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    public function getClient()
    {
        return $this->client;
    }
    
    public function getOrders()
    {
        return $this->orders;
    }
    
    public function addOrder($field, $direction)
    {
        $this->orders[] = [$field, $direction];
    }
    
    abstract protected function getRelativeUrl();

    public function find()
    {
        $response = $this->client->get($this->getRelativeUrl());
        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }
}
