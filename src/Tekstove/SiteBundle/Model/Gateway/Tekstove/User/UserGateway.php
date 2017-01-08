<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\User;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

use Tekstove\SiteBundle\Model\User\User;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

/**
 * Description of LyricGateway
 *
 * @author po_taka
 */
class UserGateway extends AbstractGateway
{
    
    const GROUP_PERMISSION_GROUPS = 'PermissionGroups';
    const GROUP_EDITABLE_FIELDS = 'User.EditableFields';
    
    protected function getRelativeUrl()
    {
        return '/users/';
    }
        
    public function buildUser($data)
    {
        $user = new User($data);
        return $user;
    }
    
    public function get($id)
    {
        $data = parent::get($id);
        $user = $this->buildUser($data['item']);
        return [
            'item' => $user,
        ];
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

    public function save(User $user)
    {
        if (!$user->getId()) {
            throw new \Exception("Not implemented");
        } else {
            $changeSet = $user->getChangeSet();
            
            $pathData = [];
            foreach ($changeSet as $property => $value) {
                $pathData[] = [
                    'op' => 'replace',
                    'path' => '/' . $property,
                    'value' => $value,
                ];
            }

            try {
                $response = $this->getClient()
                                        ->patch(
                                            $this->getRelativeUrl() . $user->getId(),
                                            ['body' => json_encode($pathData)]
                                        );
                $responseData = $this->decodeBody($response->getBody());
                return $responseData;
            } catch (RequestException $requestException) {
                if ($requestException->getCode() != 400) {
                    throw $requestException;
                }

                $validationException = new TekstoveValidationException(
                    $requestException->getMessage(),
                    0,
                    $requestException
                );
                $errors = json_decode($requestException->getBody(), true);
                $validationException->setValidationErrors($errors);
                throw $validationException;
            }
        }
    }
}
