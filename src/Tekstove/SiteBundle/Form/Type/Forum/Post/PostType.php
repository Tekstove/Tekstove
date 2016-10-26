<?php

namespace Tekstove\SiteBundle\Form\Type\Forum\Post;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of PostType
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class PostType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'text',
            \Symfony\Component\Form\Extension\Core\Type\TextareaType::class
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
                'attr' => [
                    'novalidate' => 'novalidate',
                ]
            )
        );
    }
}
