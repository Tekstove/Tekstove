<?php

namespace Tekstove\SiteBundle\Model\Gateway;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Response;

/**
 *
 * @author po_taka
 */
interface GatewayInterface
{
    public function find();
    public function get($id);
}
