<?php

namespace Tekstove\SiteBundle\Form\Type\Album;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of LyricType
 *
 * @author potaka
 */
class LyricType extends \Symfony\Component\Form\AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name'
        );

        $builder->add(
            'lyric'
        );
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => \Tekstove\SiteBundle\Model\Album\AlbumLyric::class,
                'attr' => [
                    'novalidate' => 'novalidate',
                ]
            )
        );
    }
}
