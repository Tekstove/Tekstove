<?php

namespace Tekstove\SiteBundle\Model\User\Provider;

/**
 * Description of ApiGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ApiGateway extends \Tekstove\SiteBundle\Model\Gateway\User\UserGateway
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
