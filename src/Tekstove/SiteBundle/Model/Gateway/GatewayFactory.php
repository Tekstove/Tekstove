<?php

namespace Tekstove\SiteBundle\Model\Gateway;

use GuzzleHttp\Client;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\User\UserGateway;

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
            // @TODO change with config variable
            'base_uri' => 'http://api.tekstove.fb/',
        ];
        $client = new Client($clientOptions);
        $gateway = new LyricGateway($client);
        return $gateway;
    }
    
    public static function createUserGateway()
    {
        $clientOptions = [
            // @TODO change with config variable
            'base_uri' => 'http://api.tekstove.fb/',
        ];
        $client = new Client($clientOptions);
        $gateway = new UserGateway($client);
        return $gateway;
    }
    
    public static function createUserProviderGateway()
    {
        $clientOptions = [
            // @TODO change with config variable
            'base_uri' => 'http://api.tekstove.fb/',
        ];
        $client = new Client($clientOptions);
        $gateway = new \Tekstove\SiteBundle\Model\User\Provider\ApiGateway($client);
        return $gateway;
    }
}
