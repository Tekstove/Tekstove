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
                if ($formElement->getName() == $error[$this->formErrorElementKey]) {
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
}
