<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception;

/**
 * Description of NotFoundRedirectException
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class NotFoundRedirectException extends NotFoundException
{
    private $redirectTo;
    
    public function getRedirectTo()
    {
        if ($this->redirectTo === null) {
            throw new \RuntimeException("redirectTo not set");
        }
        return $this->redirectTo;
    }

    public function setRedirectTo($redirectTo)
    {
        $this->redirectTo = $redirectTo;
    }
}
