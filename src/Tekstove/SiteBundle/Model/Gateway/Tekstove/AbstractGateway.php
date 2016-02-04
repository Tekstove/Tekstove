<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove;

use Tekstove\SiteBundle\Model\Gateway\GatewayInterface;

use GuzzleHttp\Client;

/**
 * Description of Abstractgateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
abstract class AbstractGateway implements GatewayInterface
{
    const FILTER_NOT_NULL = 'NOT_NULL';

    const GROUP_LIST = 'List';
    const GROUP_DETAILS = 'Details';
    
    private $client;
    
    private $count = 10;
    private $orders = [];
    private $filters = [];
    private $groups = [];
    
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
    
    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    abstract protected function getListRelativeUrl();
    abstract protected function getGetRelativeUrl();

    protected function getGroupsUrlParam()
    {
        if (empty($this->groups)) {
            throw new \Exception("Groups cant be empty");
        }
        return http_build_query(['groups' => $this->groups]);
    }
    
    public function find()
    {
        $url = $this->getListRelativeUrl();
        $urlHaveParams = strpos($url, '?');
        $groupsFilterChar = $urlHaveParams ? '&' : '?';
        $url .= $groupsFilterChar . $this->getGroupsUrlParam();
        
        foreach ($this->getOrders() as $order) {
            $url .= '&sort=' . urlencode($order[0]) . '&direction=' . urlencode($order[1]);
        }
        
        $filters = $this->getFilters();
        $filtersData = [
            'filters' => $filters,
        ];
        $filtersQuery = http_build_query($filtersData);
        $url .= "&{$filtersQuery}";
        
        $response = $this->client->get($url);
        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }
    
    public function get($id)
    {
        $url = $this->getGetRelativeUrl();
        $url .= $id;
        $urlHaveParams = strpos($url, '?');
        $groupsFilterChar = $urlHaveParams ? '&' : '?';
        $url .= $groupsFilterChar . $this->getGroupsUrlParam();
        
        $response = $this->client->get($url);
        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }
}
