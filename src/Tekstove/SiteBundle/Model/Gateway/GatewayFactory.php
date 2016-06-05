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
    private $baseUrl;
    
    public function __construct($baseUrl)
    {
        $this->setBaseUrl($baseUrl);
    }
    
    protected function setBaseUrl($url)
    {
        $urlClean = rtrim($url, '/');
        $this->baseUrl = $urlClean . '/';
    }

    public function createLyricGateway(TokenStorageInterface $tokenStorage)
    {
        $clientOptions = [
            'base_uri' => $this->baseUrl,
        ];
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $currentUser = $tokenStorage->getToken()->getUser();
        if ($currentUser instanceof UserInterface) {
            $apiKey = $currentUser->getApiKey();
            $client->setApikey($apiKey);
        }
        $gateway = new LyricGateway($client);
        return $gateway;
    }

    public function createLyricCredentialsGateway(TokenStorageInterface $tokenStorage)
    {
        $clientOptions = [
            'base_uri' => $this->baseUrl,
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
    
    public function createUserGateway()
    {
        $clientOptions = [
            'base_uri' => $this->baseUrl,
        ];
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $gateway = new UserGateway($client);
        return $gateway;
    }
    
    public function createUserProviderGateway()
    {
        $clientOptions = [
            'base_uri' => $this->baseUrl,
        ];
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $gateway = new \Tekstove\SiteBundle\Model\User\Provider\ApiGateway($client);
        return $gateway;
    }
    
    public function createArtistGateway()
    {
        $clientOptions = [
            'base_uri' => $this->baseUrl,
        ];
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $gateway = new \Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway($client);
        return $gateway;
    }
    
    public function createLanguageGateway()
    {
        $clientOptions = [
            'base_uri' => $this->baseUrl,
        ];
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $gateway = new \Tekstove\SiteBundle\Model\Gateway\Tekstove\Language\LanguageGateway($client);
        return $gateway;
    }
}
