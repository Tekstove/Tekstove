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
    public static function createLyricGateway()
    {
        $clientOptions = [
            'base_uri' => 'http://api.tekstove.fb/',
        ];
        $client = new Client($clientOptions);
        $gateway = new Lyric\LyricGateway($client);
        return $gateway;
    }
    
    public static function createUserGateway()
    {
        $clientOptions = [
            'base_uri' => 'http://api.tekstove.fb/',
        ];
        $client = new Client($clientOptions);
        $gateway = new User\UserGateway($client);
        return $gateway;
    }
    
    public static function createUserProviderGateway()
    {
        $clientOptions = [
            'base_uri' => 'http://api.tekstove.fb/',
        ];
        $client = new Client($clientOptions);
        $gateway = new \Tekstove\SiteBundle\Model\User\Provider\ApiGateway($client);
        return $gateway;
    }
}
