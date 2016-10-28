<?php

namespace Tekstove\SiteBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

/**
 * TekstoveApiUserToken
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class TekstoveApiUserToken extends AbstractToken
{
    public $password;

    public function __construct(array $roles = [])
    {
        parent::__construct($roles);
        $this->setAuthenticated(true);
    }
    
    public function setUser($user)
    {
        parent::setUser($user);
    }

    public function getCredentials()
    {
        throw new \Exception('not implemented');
    }
}
