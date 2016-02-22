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
        return '/users/login';
    }

    public function getUserByUsernameAndPassword($username, $password)
    {
        $client = $this->getClient();
        $response = $client->post(
            $this->getListRelativeUrl() . '/' . $username,
            [
                'body' => json_encode(
                    [
                        'password' => $password,
                    ]
                ),
            ]
        );
        
        $body = (string)$response->getBody();
        $data = $this->decodeBody($body);
        $items = $data['items'];
        
        if (empty($items)) {
            return null;
        }
        
        $user = $this->buildUser(current($items));
        return $user;
    }
    
    public function buildUser($data)
    {
        $user = new User($data);
        return $user;
    }
}
