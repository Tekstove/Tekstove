<?php

namespace Tekstove\SiteBundle\Form\Type\Artist;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of ArtistType
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class ArtistType extends \Symfony\Component\Form\AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fields = $options['fields'];

        if (in_array('name', $fields)) {
            $builder->add('name', TextType::class);
        }
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('fields');

        $resolver->setDefaults(
            [
                'attr' => [
                    'novalidate' => 'novalidate',
                ]
            ]
        );
    }
}
