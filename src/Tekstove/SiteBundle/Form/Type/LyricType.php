<?php

namespace Tekstove\SiteBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LyricType extends \Symfony\Component\Form\AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fields = $options['fields'];
        
        if (in_array('title', $fields)) {
            $builder->add('title');
        }
        
        if (in_array('text', $fields)) {
            $builder->add('text', TextareaType::class);
        }
        
        $builder->add(
            'textBg',
            null,
            [
                'label' => 'Translation'
            ]
        );
        
        $builder->add('videoYoutube', TextType::class, []);
        
        if (in_array('download', $fields)) {
            $builder->add('download', TextType::class, []);
        }
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
        $resolver->setRequired('fields');
        
        $resolver->setDefaults(
            array(
                'attr' => [
                    'novalidate' => 'novalidate',
                ]
            )
        );
    }
}
