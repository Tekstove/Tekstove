<?php

namespace Tekstove\SiteBundle\Security\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Tekstove\SiteBundle\Security\Authentication\Token\TekstoveApiUserToken;

class TekstoveApiWsseProvider implements AuthenticationProviderInterface
{
    
    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    public function __construct(UserProviderInterface $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function authenticate(TokenInterface $token)
    {
        $user = $this->userProvider->loadUserByUsernameAndPassword(
            $token->getUsername(),
            $token->password
        );

        if ($user) {
            $authenticatedToken = new TekstoveApiUserToken($user->getRoles());
            
            $authenticatedToken->setUser($user);
            return $authenticatedToken;
        }

        throw new AuthenticationException('The ' . __CLASS__ . ' authentication failed.');
    }

    public function supports(TokenInterface $token)
    {
        $support = $token instanceof TekstoveApiUserToken;
        return $support;
    }
}
