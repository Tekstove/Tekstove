<?php

namespace Tekstove\SiteBundle\Form\Type\User;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Propel\PropelBundle\Form\BaseAbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of RegisterType
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class RegisterType extends BaseAbstractType
{
    protected $options = array(
        'data_class' => 'Tekstove\SiteBundle\Model\User',
        'name'       => 'user_register',
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username');
        $builder->add('mail');
        $builder->add(
            'password',
            'repeated',
            [
                'type' => 'password',
                'first_options' => [
                    'label' => 'Password',
                ],
                'second_options' => [
                    'label' => 'Repeat Password',
                ],
            ]
        );

        $builder->add(
            'termsAccepted',
            'checkbox'
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
            )
        );
    }
}
