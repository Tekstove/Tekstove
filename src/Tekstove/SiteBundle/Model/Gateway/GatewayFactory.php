<?php

namespace Tekstove\SiteBundle\Model\Gateway;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Guzzle\GuzzleAdapter as Client;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway;

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
        return $this->createTekstoveDefaultGateway(\Tekstove\SiteBundle\Model\Gateway\Tekstove\User\UserGateway::class);
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
    
    public function createUserRegisterGateway()
    {
        return $this->createTekstoveDefaultGateway(\Tekstove\SiteBundle\Model\Gateway\Tekstove\User\RegisterGateway::class);
    }
    
    public function createArtistGateway()
    {
        return $this->createTekstoveDefaultGateway(\Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway::class);
    }
    
    public function createLanguageGateway()
    {
        return $this->createTekstoveDefaultGateway(\Tekstove\SiteBundle\Model\Gateway\Tekstove\Language\LanguageGateway::class);
    }
    
    public function createAlbumGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\Album\AlbumGateway::class
        );
    }
    
    protected function createTekstoveDefaultGateway($gatewayClass)
    {
        $clientOptions = [
            'base_uri' => $this->baseUrl,
        ];
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $gateway = new $gatewayClass($client);
        return $gateway;
    }
}
