<?php

namespace Tekstove\TekstoveBundle\Form\Type;

use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LyricType extends BaseAbstractType
{
    protected $options = array(
        'data_class' => 'Tekstove\TekstoveBundle\Model\Entity\Lyric',
        'name'       => 'lyric',
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('zaglaviePalno');
        $builder->add('fullTitleShort');
        $builder->add('upId');
        $builder->add('text');
        $builder->add('textBg');
        $builder->add('artist1');
        $builder->add('artist2');
        $builder->add('artist3');
        $builder->add('artist4');
        $builder->add('artist5');
        $builder->add('artist6');
        $builder->add('title');
        $builder->add('album1');
        $builder->add('album2');
        $builder->add('video');
        $builder->add('videoVbox7');
        $builder->add('videoYoutube');
        $builder->add('videoMetacafe');
        $builder->add('image');
        $builder->add('podnovena');
        $builder->add('ipUpload');
        $builder->add('dopylnitelnoinfo');
        $builder->add('peeSeNa');
    }
}
