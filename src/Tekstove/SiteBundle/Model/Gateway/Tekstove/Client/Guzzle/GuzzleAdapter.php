<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Guzzle;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException as TekstoveRequestException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\NotFoundException as TesktoveNotFoundException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\NotFoundRedirectException as TesktoveNotFoundRedirectException;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Response as TekstoveResponse;

/**
 * Description of GuzzleAdapter
 *
 * @author po_taka
 */
class GuzzleAdapter implements ClientInterface
{
    private $guzzle;
    
    public function __construct()
    {
        $this->guzzle = new GuzzleClient([]);
    }
    
    public function setBaseUri($uri)
    {
        $this->baseUri = $uri;
        $config = $this->guzzle->getConfig();
        $config['base_uri'] = $uri;
        $this->guzzle = new GuzzleClient($config);
    }
    
    public function post($url, $data)
    {
        try {
            $response = $this->guzzle->post($url, $data);
            $tekstoveResponse = new TekstoveResponse($response->getBody()->getContents());
            return $tekstoveResponse;
        } catch (GuzzleRequestException $e) {
            $tekstoveException = new TekstoveRequestException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
            
            $response = $e->getResponse();
            $responseBody = $response->getBody()->getContents();
            $tekstoveException->setBody($responseBody);
            
            throw $tekstoveException;
        }
    }
    
    public function patch($url, $data)
    {
        try {
            $response = $this->guzzle->patch($url, $data);
            $tekstoveResponse = new TekstoveResponse($response->getBody()->getContents());
            return $tekstoveResponse;
        } catch (GuzzleRequestException $e) {
            $tekstoveException = new TekstoveRequestException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
            
            $response = $e->getResponse();
            $responseBody = $response->getBody()->getContents();
            $tekstoveException->setBody($responseBody);
            
            throw $tekstoveException;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function delete($url)
    {
        try {
            $response = $this->guzzle->delete($url);
            $tekstoveResponse = new TekstoveResponse($response->getBody()->getContents());
            return $tekstoveResponse;
        } catch (GuzzleRequestException $e) {
            $tekstoveException = new TekstoveRequestException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
            
            $response = $e->getResponse();
            $responseBody = $response->getBody()->getContents();
            $tekstoveException->setBody($responseBody);
            
            throw $tekstoveException;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function get($url)
    {
        try {
            $guzzleResponse = $this->guzzle->get($url);
        } catch (GuzzleRequestException $e) {
            
            $responseParsed = json_decode($e->getResponse()->getBody(), true);
            
            if (isset($responseParsed['redirect']['id'])) {
                $redirectId = $responseParsed['redirect']['id'];
                $tekstoveException = new TesktoveNotFoundRedirectException(
                    $e->getMessage(),
                    $e->getCode(),
                    $e->getPrevious()
                );
                
                $tekstoveException->setRedirectTo($redirectId);
                throw $tekstoveException;
            }
            
            $tekstoveException = new TesktoveNotFoundException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
            
            $response = $e->getResponse();
            $responseBody = $response->getBody()->getContents();
            $tekstoveException->setBody($responseBody);
            
            throw $tekstoveException;
        }
        $tekstoveResponse = new TekstoveResponse($guzzleResponse->getBody());
        return $tekstoveResponse;
    }

    /**
     * Inject api key in client
     * @param string $apiKey
     */
    public function setApikey($apiKey)
    {
        $config = $this->guzzle->getConfig();
        if (empty($config['headers'])) {
            $config['headers'] = [];
        }
        $config['headers']['tekstove-apikey'] = $apiKey;
        $this->guzzle = new GuzzleClient($config);
    }
}
