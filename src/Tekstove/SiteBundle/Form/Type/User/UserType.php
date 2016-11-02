<?php

namespace Tekstove\SiteBundle\Form\Type\User;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Tekstove\SiteBundle\Model\User\User;

/**
 * Description of UserType
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class UserType extends \Symfony\Component\Form\AbstractType
{
    protected $options = array(
        'data_class' => User::class,
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id');
        $builder->add('username');
    }
    
    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
