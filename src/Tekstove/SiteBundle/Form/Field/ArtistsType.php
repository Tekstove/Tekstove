<?php

namespace Tekstove\SiteBundle\Form\Field;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * Description of ArtistType
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ArtistsType extends AbstractType
{
    public function getParent()
    {
        return CollectionType::class;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'artists';
    }
}
