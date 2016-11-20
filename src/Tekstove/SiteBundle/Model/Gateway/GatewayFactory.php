<?php

namespace Tekstove\SiteBundle\Model\Gateway;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Guzzle\GuzzleAdapter as Client;

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
    private $tekenStorage;
    
    public function __construct($baseUrl, TokenStorageInterface $tekenStorage)
    {
        $this->setBaseUrl($baseUrl);
        $this->tekenStorage = $tekenStorage;
    }
    
    protected function setBaseUrl($url)
    {
        $urlClean = rtrim($url, '/');
        $this->baseUrl = $urlClean . '/';
    }

    public function createLyricGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway::class
        );
    }

    public function createLyricCredentialsGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\CredentialsGateway::class
        );
    }
    
    public function createUserGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\User\UserGateway::class
        );
    }
    
    public function createUserPmGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\User\PmGateway::class
        );
    }
    
    public function createUserProviderGateway()
    {
        $clientOptions = [
            'base_uri' => $this->baseUrl,
            'timeout' => 4,
        ];
        $client = new Client();
        $client->setBaseUri($clientOptions['base_uri']);
        $gateway = new \Tekstove\SiteBundle\Model\User\Provider\ApiGateway($client);
        return $gateway;
    }
    
    public function createUserRegisterGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\User\RegisterGateway::class
        );
    }
    
    public function createArtistGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway::class
        );
    }
    
    public function createLanguageGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\Language\LanguageGateway::class
        );
    }
    
    public function createForumCategoryGateway()
    {
        return $this->createTekstoveDefaultGateway(
            Tekstove\Forum\CategoryGateway::class
        );
    }
    
    public function createForumTopicGateway()
    {
        return $this->createTekstoveDefaultGateway(Tekstove\Forum\TopicGateway::class);
    }
    
    public function createForumPostGateway()
    {
        return $this->createTekstoveDefaultGateway(Tekstove\Forum\PostGateway::class);
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
            'timeout' => 4,
        ];
        $client = new Client();
        $currentUser = $this->tekenStorage->getToken()->getUser();
        if ($currentUser instanceof UserInterface) {
            $apiKey = $currentUser->getApiKey();
            $client->setApikey($apiKey);
        }
        $client->setBaseUri($clientOptions['base_uri']);
        $gateway = new $gatewayClass($client);
        return $gateway;
    }
}
