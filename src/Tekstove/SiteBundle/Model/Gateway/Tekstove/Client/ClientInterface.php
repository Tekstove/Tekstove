<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Client;

/**
 *
 * @author po_taka
 */
interface ClientInterface
{
    public function setBaseUri($uri);
    public function post($url, $datas);
}