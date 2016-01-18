<?php

namespace Tekstove\SiteBundle\Model\Gateway\User;

use Tekstove\SiteBundle\Model\Gateway\AbstractGateway;

use Tekstove\SiteBundle\Model\User\User;

/**
 * Description of LyricGateway
 *
 * @author po_taka
 */
class UserGateway extends AbstractGateway
{
    protected function getListRelativeUrl()
    {
        return '/user';
    }
    
    protected function getGetRelativeUrl()
    {
        throw new \Exception('not implemented');
    }
    
    public function buildUser($data)
    {
        $user = new User($data);
        return $user;
    }
    
    public function find()
    {
        $data = parent::find();
        $users = [];
        foreach ($data['items'] as $userData) {
            $users[] = $this->buildUser($userData);
        }

        $data['items'] = $users;
        return $data;
    }
}
