<?php

namespace Tekstove\TekstoveBundle\Model\User;

use Tekstove\TekstoveBundle\Model\User;
use Tekstove\TekstoveBundle\Model\UserQuery;
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

    /**
     *
     * @var UserQuery
     */
    private $userManager;

    public function __construct(UserQuery $manager)
    {
        $this->userManager = $manager;
    }

    public function loadUserByUsername($username)
    {
        // make a call to your webservice here
        $user = $this->userManager->findOneByUsername($username);
        // pretend it returns an array on success, false if there is no user

        if ($user) {
            return $user;
        } else {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf(
                    'Instances of "%s" are not supported.',
                    get_class($user)
                )
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Tekstove\TekstoveBundle\Model\User';
    }
}
