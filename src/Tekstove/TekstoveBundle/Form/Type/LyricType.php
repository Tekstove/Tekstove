<?php

namespace Tekstove\TekstoveBundle\Form\Type;

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
        $builder->add('views');
        $builder->add('popularity');
    }
}
