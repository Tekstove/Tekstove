<?php

namespace Tekstove\TekstoveBundle\Model\Gateway;

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
        $client = new Client();
        $gateway = new Lyric\LyricGateway($client);
        return $gateway;
    }
}
