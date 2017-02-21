<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Client;

/**
 *
 * @author po_taka
 */
interface ClientInterface
{
    public function setBaseUri($uri);
    
    /**
     * @param type $url
     * @param type $datas
     * @return Response
     */
    public function post($url, $datas);
    
    /**
     * @param type $url
     * @param type $data
     */
    public function patch($url, $data);

    /**
     * @param type $url
     * @return Response
     */
    public function get($url);
    
    /**
     * @param string $url
     */
    public function delete($url);
    
    public function setApikey($apiKey);

    /**
     * @param string $ip
     */
    public function setIp($ip);
}
