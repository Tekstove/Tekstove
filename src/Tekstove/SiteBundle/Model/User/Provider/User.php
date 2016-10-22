<?php

namespace Tekstove\SiteBundle\Model\User\Provider;

use Tekstove\SiteBundle\Model\User\User as BaseUser;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of User
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class User extends BaseUser implements UserInterface
{
    private $unreadPmCount;
    
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->unreadPmCount = $data['unreadPmCount'];
    }

    
    public function eraseCredentials()
    {
        // @TODO erase roles when implemented;
        return;
    }

    public function getRoles()
    {
        return [];
    }

    public function getSalt()
    {
        return '';
    }
    
    public function getUnreadPmCount()
    {
        return $this->unreadPmCount;
    }
}
