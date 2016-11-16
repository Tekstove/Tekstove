<?php

namespace Tekstove\SiteBundle\Form\Type\Forum\Topic;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Description of TopicNewType
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class TopicNewType extends TopicEditType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add(
            'postText',
            TextareaType::class
        );
    }
}
