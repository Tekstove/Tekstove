<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Guzzle;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException as TekstoveRequestException;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;

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
        $this->guzzle = new GuzzleClient();
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
            return $this->guzzle->post($url, $data);
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
}