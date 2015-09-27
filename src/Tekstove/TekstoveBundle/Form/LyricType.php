<?php

namespace Tekstove\TekstoveBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LyricType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('text')
            ->add(
                'textBg',
                null,
                [
                    'label' => 'Bulgarian translation'
                ]
            )
            ->add('extraInfo')
        ;
        
        $builder->add(
            'videoYoutube',
            null,
            [
                'label' => 'youtube video',
            ]
        );
        
        $builder->add('videoMetacafe')
                ->add('videoVbox7')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Tekstove\TekstoveBundle\Entity\Lyric',
                'attr' => [
                    'novalidate' => 'novalidate',
                ]
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tekstove_tekstovebundle_lyric';
    }
}
