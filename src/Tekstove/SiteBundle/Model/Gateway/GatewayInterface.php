<?php

namespace Tekstove\SiteBundle\Model\Gateway;

/**
 *
 * @author po_taka
 */
interface GatewayInterface
{
    public function find();
    public function get($id);
    /**
     * Results per page
     */
    public function setLimit($limit);
    public function setOffset($offset);
    public function addFilter($field, $value, $operator = '=');
    public function setGroups(array $groups);
}
