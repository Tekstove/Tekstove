<?php

namespace Tekstove\TekstoveBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LyricType extends BaseAbstractType
{
    protected $options = array(
        'data_class' => 'Tekstove\TekstoveBundle\Model\Lyric',
        'name'       => 'lyric',
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('text');
        $builder->add('textBg');
        $builder->add(
            'languages',
            null,
            [
                'attr' => [
                    'class' => 't-selectSmart',
                ],
            ]
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
