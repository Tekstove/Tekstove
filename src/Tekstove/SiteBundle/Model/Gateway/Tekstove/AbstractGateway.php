<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove;

use Tekstove\SiteBundle\Model\Gateway\GatewayInterface;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\ClientInterface;

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
    private $params = [];
    private $groups = [];
    
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
    
    /**
     * @return ClientInterface
     */
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
    
    /**
     * Add param in client request
     * @param string $param
     * @param string $value
     */
    public function addParam($param, $value)
    {
        $this->params[$param] = $value;
    }

    public function setGroups($groups)
    {
        $this->groups = $groups;
    }

    abstract protected function getRelativeUrl();

    protected function getGroupsUrlParam()
    {
        if (empty($this->groups)) {
            throw new \Exception("Groups cant be empty");
        }
        return http_build_query(['groups' => $this->groups]);
    }
    
    public function find()
    {
        $url = $this->getRelativeUrl();
        $urlHaveParams = strpos($url, '?');
        $groupsFilterChar = $urlHaveParams ? '&' : '?';
        $url .=  $groupsFilterChar . $this->getGroupsUrlParam();
        
        foreach ($this->getOrders() as $order) {
            $url .= '&sort=' . urlencode($order[0]) . '&direction=' . urlencode($order[1]);
        }
        
        $filters = $this->getFilters();
        $filtersData = [
            'filters' => $filters,
        ];
        
        $allParsms = array_merge($filtersData, $this->params);
        $filtersQuery = http_build_query($allParsms);
        $url .= "&{$filtersQuery}";
        
        $response = $this->client->get($url);
        $body = $response->getBody();
        $data = $this->decodeBody($body);
        return $data;
    }
    
    protected function decodeBody($body)
    {
        return json_decode($body, true);
    }
    
    public function get($id)
    {
        $url = $this->getRelativeUrl();
        $url .= '/' . $id;
        $urlHaveParams = strpos($url, '?');
        $groupsFilterChar = $urlHaveParams ? '&' : '?';
        $url .= $groupsFilterChar . $this->getGroupsUrlParam();
        
        $response = $this->client->get($url);
        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }
}
