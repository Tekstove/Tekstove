<?php

namespace Tekstove\SiteBundle\Model\Gateway;

use App\Gateway\Tekstove\V4\Lyric\LyricGateway as LyricGatewayV4;
use App\Gateway\Tekstove\V4\Publisher\PublisherGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Guzzle\GuzzleAdapter as Client;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Description of GatewayFactory
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class GatewayFactory
{
    private $baseUrl;
    private $tekenStorage;
    private $requestStack;
    
    public function __construct($baseUrl, TokenStorageInterface $tekenStorage, RequestStack $requestStack)
    {
        $this->setBaseUrl($baseUrl);
        $this->tekenStorage = $tekenStorage;
        $this->requestStack = $requestStack;
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

    public function createLyricV4Gateway()
    {
        return $this->createTekstoveDefaultGateway(
            LyricGatewayV4::class
        );
    }

    public function createLyricCredentialsGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\CredentialsGateway::class
        );
    }

    public function createLyricPopularityHistoryGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricPopularHistoryGateway::class
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
    
    public function createArtistGateway(): ArtistGateway
    {
        return $this->createTekstoveDefaultGateway(
            ArtistGateway::class
        );
    }

    public function createArtistV4Gateway()
    {
        $gateway = $this->createArtistGateway();
        $gateway->setRelativeUrlToV4();

        return $gateway;
    }

    public function createArtistCredentialsGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\CredentialsGateway::class
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

    public function createAlbumCredentialsGateway()
    {
        return $this->createTekstoveDefaultGateway(
            \Tekstove\SiteBundle\Model\Gateway\Tekstove\Album\AlbumCredentialsGateway::class
        );
    }

    public function createTekstovePublisherGateway()
    {
        return $this->createTekstoveDefaultGateway(
            PublisherGateway::class
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
        $client->setIp($this->requestStack->getCurrentRequest()->getClientIp());
        $gateway = new $gatewayClass($client);
        return $gateway;
    }
}
