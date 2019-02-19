<?php

namespace App\Twig\Filter;

use \Twig_Extension;
use Twig_SimpleFilter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Description of LoggedOnlyLink
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LoggedOnlyLink extends Twig_Extension
{
    private $tokenStorage;
    private $urlGenerator;
    
    public function __construct(TokenStorageInterface $tokenStorage, UrlGeneratorInterface $urlGenerator)
    {
        $this->tokenStorage = $tokenStorage;
        $this->urlGenerator = $urlGenerator;
    }
    
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('loggedOnly', [$this, 'filter']),
        );
    }

    public function filter($link)
    {
        if ($this->isLogged()) {
            return $link;
        }
        
        return $this->urlGenerator->generate('login');
    }

    public function getName()
    {
        return 'logged_only';
    }
    
    private function isLogged()
    {
        $currentUser = $this->tokenStorage->getToken()->getUser();
        if ($currentUser instanceof UserInterface) {
            return true;
        }
        
        return false;
    }
}
