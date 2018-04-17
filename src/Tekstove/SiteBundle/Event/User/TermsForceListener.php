<?php

namespace Tekstove\SiteBundle\Event\User;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * This listener ensure that logged user must accept latest terms of service
 *
 * @author potaka
 */
class TermsForceListener
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $user = $this->tokenStorage->getToken()->getUser();

        if (!$user instanceof \Tekstove\SiteBundle\Model\User\Provider\User) {
            return;
        }

        if ($user->getTermsAccepted()) {
            // terms are accepted, continue with the page loading
            return;
        }

        if (strpos($event->getRequest()->getPathInfo(), '/user/edit/') !== 0) {
            $response = new \Symfony\Component\HttpFoundation\RedirectResponse('/user/edit/' . $user->getId(), 302);
            $event->setResponse($response);
            $event->stopPropagation();
        }
    }
}
