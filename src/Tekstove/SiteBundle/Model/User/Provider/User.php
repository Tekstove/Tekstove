<?php

namespace Tekstove\SiteBundle\Model\User\Provider;

use Tekstove\SiteBundle\Model\User\User as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * Description of User
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class User extends BaseUser implements UserInterface, EquatableInterface
{
    private $unreadPmCount;
    
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->unreadPmCount = $data['unreadPmCount'];
    }

    
    public function eraseCredentials()
    {
        return true;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        return '';
    }
    
    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof User) {
            return false;
        }
        
        if ($user->getId() === $this->getId()) {
            return true;
        }
        
        return false;
    }
    
    public function getUnreadPmCount()
    {
        return $this->unreadPmCount;
    }
}
