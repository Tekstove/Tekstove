<?php

namespace Tekstove\SiteBundle\Form\Field;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Description of ArtistType
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ArtistType extends AbstractType
{
    public function getParent()
    {
        return ChoiceType::class;
    }
}
