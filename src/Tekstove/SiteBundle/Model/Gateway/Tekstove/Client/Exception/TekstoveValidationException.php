<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception;

/**
 * Description of ValidationException
 *
 * @author po_taka
 */
class TekstoveValidationException extends RequestException
{
    private $validationErrors = [];
    
    public function setValidationErrors($validationErrors)
    {
        $this->validationErrors = $validationErrors;
    }

    public function getValidationErrors()
    {
        return $this->validationErrors;
    }
}