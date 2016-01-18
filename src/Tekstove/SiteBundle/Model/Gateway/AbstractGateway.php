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
    const FILTER_NOT_NULL = 'NOT_NULL';
    
    private $client;
    
    private $count = 10;
    private $orders = [];
    private $filters = [];
    
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
    
    public function getFilters()
    {
        return $this->filters;
    }
    
    public function addFilter($field, $value, $operator = '=')
    {
        $this->filters[] = [
            'field' => $field,
            'value' => $value,
            'operator' => $operator,
        ];
    }
    
    abstract protected function getListRelativeUrl();
    abstract protected function getGetRelativeUrl();

    public function find()
    {
        $url = $this->getListRelativeUrl();
        foreach ($this->getOrders() as $order) {
            $doQuestionMarkExistInQuery = strpos($url, '?');
            $firstParamConcatChar = $doQuestionMarkExistInQuery ? '&' : '?';
            $url .= $firstParamConcatChar . 'sort=' . urlencode($order[0]) . '&direction=' . urlencode($order[1]);
        }
        
        $doQuestionMarkExistInQuery = strpos($url, '?');
        $filters = $this->getFilters();
        $filtersData = [
            'filters' => $filters,
        ];
        $filtersQuery = http_build_query($filtersData);
        if ($doQuestionMarkExistInQuery) {
            $url .= "&{$filtersQuery}";
        } else {
            $url .= "?{$filtersQuery}";
        }
        
        
        $response = $this->client->get($url);
        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }
    
    public function get($id)
    {
        $url = $this->getGetRelativeUrl();
        $url .= $id;
        $response = $this->client->get($url);
        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }
}
