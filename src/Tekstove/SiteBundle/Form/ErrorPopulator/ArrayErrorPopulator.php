<?php

namespace Tekstove\SiteBundle\Form\ErrorPopulator;

use Symfony\Component\Form\FormInterface;
use \Symfony\Component\Form\FormError;

/**
 * ArrayErrorPopulator
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ArrayErrorPopulator
{
    private $formErrorMessageKey = 'message';
    private $formErrorElementKey = 'element';
    
    private $aliases = [];
    
    /**
     * Populate form with errors from given array
     * @param FormInterface $form
     * @param array $errors
     */
    public function populateFormErrors(FormInterface $form, array $errors)
    {
        foreach ($errors as $error) {
            $formError = new FormError($error[$this->formErrorMessageKey]);
            $formErrorMatched = false;
            foreach ($form as $formElement) {
                /* @var $formElement FormInterface */
                if (in_array($error[$this->formErrorElementKey], $this->getMatchinFormElements($formElement->getName()))) {
                    $formElement->addError($formError);
                    $formErrorMatched = true;
                    break;
                }
            }

            if (!$formErrorMatched) {
                $form->addError($formError);
            }
        }
    }
    
    private function getMatchinFormElements($element)
    {
        $elements = [$element];
        if (isset($this->aliases[$element])) {
            $elements = array_merge($this->aliases[$element], $elements);
        }
        
        return $elements;
    }
    
    public function addAlias($formElement, $errorElement)
    {
        if (!!isset($this->aliases[$formElement])) {
            $this->aliases[$formElement] = [];
        }
        $this->aliases[$formElement][] = $errorElement;
    }
}
