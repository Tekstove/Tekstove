<?php

namespace Tekstove\SiteBundle\Security\Firewall;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Tekstove\SiteBundle\Security\Authentication\Token\TekstoveApiUserToken;
use Symfony\Component\HttpFoundation\Request;

class TekstoveApiWsseListener extends \Symfony\Component\Security\Http\Firewall\AbstractAuthenticationListener
{
    protected function handlePost(\Symfony\Component\HttpFoundation\Request $request)
    {
        $username = $request->get('_username');
        $password = $request->get('_password');

        if (!is_string($username) || !is_string($password)) {
            return;
        }

        $token = new TekstoveApiUserToken();
        $token->setUser($username);
        $token->password = $password;

        try {
            $authToken = $this->authenticationManager->authenticate($token);
            return $authToken;
        } catch (AuthenticationException $failed) {
            throw $failed;
            // ... you might log something here

            // To deny the authentication clear the token. This will redirect to the login page.
            // Make sure to only clear your token, not those of other authentication listeners.
            // $token = $this->tokenStorage->getToken();
            // if ($token instanceof WsseUserToken && $this->providerKey === $token->getProviderKey()) {
            //     $this->tokenStorage->setToken(null);
            // }
//             return;
        }
    }

    protected function requiresAuthentication(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            return true;
        }
        return false;
    }

    protected function attemptAuthentication(Request $request)
    {
        return $this->handlePost($request);
    }
}
