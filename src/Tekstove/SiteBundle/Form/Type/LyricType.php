<?php

namespace Tekstove\SiteBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class LyricType extends \Symfony\Component\Form\AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('text', TextareaType::class);
        $builder->add(
            'textBg',
            null,
            [
                'label' => 'Translation'
            ]
        );
//        $builder->add(
//            'languages',
//            null
//            [
//                'choice_label' => 'name',
//                'attr' => [
//                    'class' => 't-selectSmart',
//                ],
//            ]
//        );
        
//        $builder->add('videoYoutube');
//        $builder->add('videoVbox7');
//        $builder->add('videoMetacafe');
//        
//        $builder->add(
//            'download',
//            null,
//            [
//                'label' => 'Download link',
//            ]
//        );
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
