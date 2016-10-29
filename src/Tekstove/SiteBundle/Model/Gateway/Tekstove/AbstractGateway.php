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
    const FILTER_LIKE = 'like';
    
    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    const GROUP_LIST = 'List';
    const GROUP_DETAILS = 'Details';
    const GROUP_ACL = 'Acl';
    
    private $client;
    
    private $limit = 10;
    private $offset = 1;
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
    
    public function setOffset($offset)
    {
        $this->offset = (int) $offset;
    }

    public function setLimit($limit)
    {
        $this->limit = (int) $limit;
    }

    public function addOrder($field, $direction)
    {
        $this->orders[] = [
            'field' => $field,
            'direction' => $direction,
        ];
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

    public function setGroups(array $groups)
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
        
        
        $ordersQuery = http_build_query(
            ['order' => $this->getOrders()]
        );
        
        $filters = $this->getFilters();
        $filtersData = [
            'filters' => $filters,
        ];
        
        $allParsms = array_merge($filtersData, $this->params);
        $filtersQuery = http_build_query($allParsms);
        $url .= "&{$filtersQuery}";
        $url .= "&{$ordersQuery}";
        $page = 1 + $this->offset / $this->limit;
        $url .= "&page={$page}";
        $url .= "&limit={$this->limit}";
        
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
        if ($this->params) {
            $url .= '&' . http_build_query($this->params);
        }
        
        $response = $this->client->get($url);
        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }
    
    /**
     * @param type $id
     * @return array
    */
    public function delete($id)
    {
        $url = $this->getRelativeUrl();
        $url .= '/' . $id;
        $response = $this->client->delete($url);
        $body = $response->getBody();
        $data = json_decode($body, true);
        return $data;
    }
}
