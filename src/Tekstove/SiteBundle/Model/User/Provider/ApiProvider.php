<?php

namespace Tekstove\SiteBundle\Model\User\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class ApiProvider implements UserProviderInterface
{
    private $gateway;
    
    public function __construct(ApiGateway $gateway)
    {
        $this->gateway = $gateway;
        $this->gateway->setGroups(['Details']);
    }

    public function loadUserByUsername($username)
    {
        throw new \Exception('Not implemented. Use `loadUserByUsernameAndPassword`');
    }
    
    public function loadUserByUsernameAndPassword($username, $password)
    {
        $user = $this->gateway->getUserByUsernameAndPassword($username, $password);
        if (!$user) {
            throw new UsernameNotFoundException("Username or password are wrong");
        }
        
        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof \Tekstove\SiteBundle\Model\User\Provider\User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }
        
        $refreshedUser = $this->gateway->loadUserByApiKey(
            $user->getApiKey()
        );
        
        return $refreshedUser;
    }

    public function supportsClass($class)
    {
        if ($class == User::class) {
            return true;
        }
        
        return false;
    }
}
