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
        return '/user/credentials';
    }
    
    public function buildUser($data)
    {
        $user = new User($data);
        return $user;
    }
}
