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
        return '/users';
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
    
    public function populateUsers($data, $idGetter, $setter, $label = 'List')
    {
        $userIds = [];
        foreach ($data as $item) {
            $id = $item->{$idGetter}();
            if ($id) {
                $userIds[] = $item->{$idGetter}();
            }
        }
        
        if (empty($userIds)) {
            return $data;
        }
        
        $this->addFilter('id', $userIds, 'in');
        $usersData = $this->find();
        $users = $usersData['items'];
        foreach ($data as $item) {
            $userId = $item->{$idGetter}();
            foreach ($users as $user) {
                if ($user->getId() == $userId) {
                    $item->{$setter}($user);
                }
            }
        }
    }
}
