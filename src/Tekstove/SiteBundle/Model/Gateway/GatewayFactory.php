<?php

namespace Tekstove\SiteBundle\Model\Gateway;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Guzzle\GuzzleAdapter as Client;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\User\UserGateway;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $gateway = new LyricGateway($client);
        return $gateway;
    }

    public static function createLyricCredentialsGateway(TokenStorageInterface $tokenStorage)
    {
        $clientOptions = [
            // @TODO change with config variable
            'base_uri' => 'http://api.tekstove.fb/',
        ];
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $currentUser = $tokenStorage->getToken()->getUser();
        if ($currentUser instanceof UserInterface) {
            $apiKey = $currentUser->getApiKey();
            $client->setApikey($apiKey);
        }
        $gateway = new Tekstove\Lyric\CredentialsGateway($client);
        return $gateway;
    }
    
    public static function createUserGateway()
    {
        $clientOptions = [
            // @TODO change with config variable
            'base_uri' => 'http://api.tekstove.fb/',
        ];
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $gateway = new UserGateway($client);
        return $gateway;
    }
    
    public static function createUserProviderGateway()
    {
        $clientOptions = [
            // @TODO change with config variable
            'base_uri' => 'http://api.tekstove.fb/',
        ];
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $gateway = new \Tekstove\SiteBundle\Model\User\Provider\ApiGateway($client);
        return $gateway;
    }
}
