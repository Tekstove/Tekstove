<?php

namespace Tekstove\TekstoveBundle\Model;

use Tekstove\TekstoveBundle\Model\Base\User as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class User extends BaseUser implements UserInterface
{

    public function eraseCredentials()
    {
        
    }

    public function getPermission($name)
    {
        foreach ($this->getPermissionGroupUsers() as $permissionGroup) {
            $group = $permissionGroup->getPermissionGroup();
            foreach($group->getPermissionGroupPermissions() as $groupPermission) {
                $permissionName = $groupPermission->getPermission()->getName();
                if ($permissionName === $name) {
                    return $groupPermission->getPermission()->getValue();
                }
            }
        }
    }
    
    public function getRoles()
    {
        return [];
    }

    public function getSalt()
    {
        return '';
    }
    
    public function getClassName()
    {
        return 'className';
    }

}
