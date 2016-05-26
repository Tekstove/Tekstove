<?php

namespace Tekstove\SiteBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LyricType extends \Symfony\Component\Form\AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fields = $options['fields'];
        
        $builder->add(
            'artists',
            CollectionType::class,
            [
                'allow_add' => true,
                'allow_delete' => true,
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'choice_name' => 'name',
                    'choice_value' => 'id',
                ]
            ]
        );
        
        if (in_array('title', $fields)) {
            $builder->add('title');
        }
        
        if (in_array('text', $fields)) {
            $builder->add('text', TextareaType::class);
        }
        
        $builder->add(
            'textBg',
            TextareaType::class,
            [
                'label' => 'Translation'
            ]
        );
        
        $builder->add('videoYoutube', TextType::class, []);
        $builder->add('videoVbox7', TextType::class, []);
        
        $builder->add('extraInfo', TextType::class, []);
        
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
