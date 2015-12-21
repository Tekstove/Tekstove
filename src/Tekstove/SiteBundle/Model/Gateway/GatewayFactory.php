<?php

namespace Tekstove\SiteBundle\Model\Gateway;

use GuzzleHttp\Client;

/**
 * Description of GatewayFactory
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class GatewayFactory
{
    public function createLyricGateway()
    {
        $clientOptions = [
            'base_uri' => 'http://api.tekstove.fb/',
        ];
        $client = new Client($clientOptions);
        $gateway = new Lyric\LyricGateway($client);
        return $gateway;
    }
}
