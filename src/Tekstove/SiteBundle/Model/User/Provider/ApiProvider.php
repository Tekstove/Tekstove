<?php

namespace Tekstove\SiteBundle\Model\User\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use Tekstove\SiteBundle\Model\User\Provider\ApiGateway;

/**
 * Description of ApiProvider
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ApiProvider implements UserProviderInterface
{
    private $gateway;
    
    public function __construct(ApiGateway $gateway)
    {
        $this->gateway = $gateway;
        $this->gateway->setGroups(['Credentials', 'Details']);
    }

    
    public function loadUserByUsername($username)
    {
        $this->gateway->addFilter('username', $username);
        $result = $this->gateway->find();
        $users = $result['items'];
        if (empty($users)) {
            throw new UsernameNotFoundException("Username doesn't exists");
        }
        
        if (count($users) > 1) {
            throw new \Exception("Found more than one user");
        }
        
        return $users[0];
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof \Tekstove\SiteBundle\Model\User\Provider\User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }
        
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        if ($class == 'Tekstove\SiteBundle\Model\User\Provider\User') {
            return true;
        }
        
        return false;
    }
}
