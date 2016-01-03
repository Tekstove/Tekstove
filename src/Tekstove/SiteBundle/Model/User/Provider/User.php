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
}
