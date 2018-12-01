<?php

namespace Tekstove\SiteBundle\Model\User\Provider;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\User\UserGateway;

/**
 * Description of ApiGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ApiGateway extends UserGateway
{
    protected function getListRelativeUrl()
    {
        return '/users/';
    }

    public function getUserByUsernameAndPassword($username, $password)
    {
        $client = $this->getClient();
        $response = $client->post(
            $this->getListRelativeUrl() . 'login',
            [
                'body' => json_encode(
                    [
                        'username' => $username,
                        'password' => $password,
                    ]
                ),
            ]
        );
        
        $body = (string)$response->getBody();
        $data = $this->decodeBody($body);
        
        if (empty($data['item'])) {
            return null;
        }
        
        $item = $data['item'];
        
        $user = $this->buildUser($item);
        return $user;
    }
    
    public function loadUserByApiKey($apiKey)
    {
        $client = $this->getClient();
        $client->setApikey($apiKey);
        $response = $client->get(
            $this->getListRelativeUrl() . 'login'
        );
        
        $body = (string)$response->getBody();
        $data = $this->decodeBody($body);
        $items = $data['item'];
        
        if (empty($items)) {
            return null;
        }
        
        $user = $this->buildUser($items);
        return $user;
    }
    
    public function buildUser($data)
    {
        $user = new User($data);
        return $user;
    }
}
