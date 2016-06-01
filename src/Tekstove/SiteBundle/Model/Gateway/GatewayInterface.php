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
}
