<?php

namespace Tekstove\TekstoveBundle\Model\User;

use Tekstove\TekstoveBundle\Model\User;
use Tekstove\TekstoveBundle\Model\User\Manager;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * Description of UserProvider
 *
 * @author potaka
 */
class Provider implements UserProviderInterface
{

    private $userManager;

    public function __construct(Manager $manager)
    {
        $this->userManager = $manager;
    }

    public function loadUserByUsername($username)
    {
        // make a call to your webservice here
        $userData = $this->userManager->findByUsername($username);
        // pretend it returns an array on success, false if there is no user

        if ($userData) {
            return new User($userData, $this->userManager);
        } else {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
            sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Tekstove\TekstoveBundle\Model\User';
    }

}
